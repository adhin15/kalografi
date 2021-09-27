<?php

namespace App\Http\Controllers;

use App\Http\Services\MidtransService;
use App\Models\additionals;
use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction;

class PaymentController extends Controller
{

    private $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function createInstallmentTransaction($booking, $grossAmount)
    {
        $this->midtransService->initPaymentGateway();

        $additionalServices = additionals::query()
            ->whereIn('id', json_decode($booking->additionals))
            ->get();

        if ($booking->paket_id) {
            $packageId = $booking->pakets->id;
            $packageName = $booking->pakets->namapaket . ' ' . $booking->pakets->kategori;
            $packagePrice = $booking->pakets->price;
            $packageCategory = $booking->pakets->kategori;
        } elseif ($booking->custom_id) {
            $packageId = 'CUSTOM';
            $packageName = 'Custom Package';
            $packagePrice = $booking->custom->price;
            $packageCategory = 'Custom Package';
        }

        $packageDetails = [
            'id' => $packageId,
            'name' => $packageName,
            'price' => $packagePrice,
            'quantity' => 1,
            'category' => $packageCategory
        ];

        $photobookDetails = [
            'id' => $booking->photobooks->id,
            'name' => $booking->photobooks->photobook,
            'price' => $booking->photobooks->price,
            'quantity' => $booking->pbqty,
            'category' => 'Photo Book'
        ];

        $printedphotoDetails = [
            'id' => $booking->printedphotos->id,
            'name' => $booking->printedphotos->printedphoto,
            'price' => $booking->printedphotos->price,
            'quantity' => $booking->ppqty,
            'category' => 'Printed Photo'
        ];

        $initialPrice = $booking->totalprice * (100 / (100 - $booking->discount->jumlah));
        $discountedPrice = ($initialPrice * $booking->discount->jumlah) / 100;

        $discountDetails = [
            'id' => $booking->discount_id,
            'name' => strtoupper($booking->discount->nama) . ' (Discount)',
            'price' => -$discountedPrice,
            'quantity' => 1,
            'category' => 'Discount'
        ];

        $installmentDetails = [
            'id' => 'INS',
            'name' => 'Installment Amount',
            'price' => -$booking->installment,
            'quantity' => 1,
            'category' => 'Installment Payment'
        ];

        $item_details = array($packageDetails, $printedphotoDetails, $photobookDetails, $discountDetails, $installmentDetails);

        if ($booking->additionals) {
            foreach ($additionalServices as $item) {
                $additionalDetails[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => 1,
                    'category' => 'Additional Service'
                ];
            }

            $item_details = array_merge(array($packageDetails), array($printedphotoDetails), array($photobookDetails), $additionalDetails, array($discountDetails), array($installmentDetails));
        }

        $customerDetails = [
            'first_name' => $booking->fullname,
            'email' => $booking->email,
            'phone' => $booking->phonenumber
        ];

        $params = [
            'enable_payments' => Booking::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $booking->order_id,
                'gross_amount' => $grossAmount
            ],
            'item_details' => $item_details,
            'customer_details' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T', strtotime($booking->created_at)),
                'unit' => Booking::EXPIRY_UNIT,
                'duration' => Booking::EXPIRY_DURATION
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        if ($snapToken) {
            $booking->paymentToken = $snapToken;
            $booking->save();
        }

        return $booking;
    }

    //MIDTRANS TESTING
    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $this->midtransService->initPaymentGateway();
        $paymentNotification = new Notification();

        $transactionStatus = $paymentNotification->transaction_status;
        $transactionOrderID = $paymentNotification->order_id;

        $booking = Booking::query()
            ->where('order_id', $transactionOrderID)
            ->firstOrFail();

        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture' || $transactionStatus === 'success') {
            if ($booking->paymentStatus === 'CREATED') {
                if ($booking->payment_termination == 1) {
                    $booking->paymentStatus = 'FULLY_PAID';

                } elseif ($booking->payment_termination == 2) {
                    $booking->paymentStatus = 'DOWN_PAYMENT_PAID';
                    $booking->installment = $booking->downPayment;
                    $booking->downPayment = null;

                }
            } elseif ($booking->paymentStatus === 'FULL_PAYMENT_PENDING') {
                $booking->paymentStatus = 'FULLY_PAID';

            } elseif ($booking->paymentStatus === 'DOWN_PAYMENT_PENDING') {
                $booking->paymentStatus = 'DOWN_PAYMENT_PAID';
                $booking->installment = $booking->downPayment;
                $booking->downPayment = null;

            } elseif ($booking->paymentStatus === 'DOWN_PAYMENT_PAID' || $booking->paymentStatus === 'INSTALLMENT_PENDING') {
                $booking->paymentStatus = 'INSTALLMENT_PAID';
                $booking->installment = null;
            }
        } elseif ($transactionStatus === 'pending') {
            if ($booking->paymentStatus === 'CREATED') {
                if ($booking->payment_termination == 1) {
                    $booking->paymentStatus = 'FULL_PAYMENT_PENDING';

                } elseif ($booking->payment_termination == 2) {
                    $booking->paymentStatus = 'DOWN_PAYMENT_PENDING';
                }
            } elseif ($booking->paymentStatus === 'DOWN_PAYMENT_PAID') {
                $booking->paymentStatus = 'INSTALLMENT_PENDING';
            }
        }

        $booking->update();

        return response('OK', 200);
    }

    public function snapFinish(Request $request)
    {
        $bookingOrderId = $request->order_id;
        $booking = Booking::query()
            ->where('order_id', $bookingOrderId)
            ->firstOrFail();

        if ($booking->paymentStatus === 'FULL_PAYMENT_PENDING') {
            $alertType = 'danger';
            $alertMessage = 'Please Complete Payment!';

        } else if ($booking->paymentStatus === 'FULLY_PAID') {
            $alertType = 'message';
            $alertMessage = 'Payment Complete!';

        } else if ($booking->paymentStatus === 'DOWN_PAYMENT_PENDING') {
            $alertType = 'danger';
            $alertMessage = 'Please Complete Down Payment!';

        } else if ($booking->paymentStatus === 'DOWN_PAYMENT_PAID') {
            $alertType = 'message';
            $alertMessage = 'Down Payment Paid!';
            $paymentCode = 'INS';
            $order_id = $paymentCode . '/' . '000' . random_int(1000, 9999);
            $grossAmount = $booking->installment;
            $booking->order_id = $order_id;
            $booking->update();

            $this->midtransService->initPaymentGateway();
            $this->createInstallmentTransaction($booking, $grossAmount);

        } else if ($booking->paymentStatus === 'INSTALLMENT_PENDING') {
            $alertType = 'danger';
            $alertMessage = 'Please Complete Installment Payment!';

        } else if ($booking->paymentStatus === 'INSTALLMENT_PAID') {
            $alertType = 'message';
            $alertMessage = 'Installment Paid! Payment Complete!';
        }

        return redirect('/search?order_id=' . $booking->id)->with($alertType, $alertMessage);
    }

    public function snapUnfinished(Request $request)
    {
        $bookingOrderId = $request->query('order_id');
        $booking = Booking::query()
            ->where('order_id', $bookingOrderId)
            ->firstOrFail();

        return redirect('/search?order_id=' . $booking->id)->with('message', 'Payment Not Complete!');
    }

    public function snapFailed(Request $request)
    {
        $bookingOrderId = $request->order_id;
        $booking = Booking::query()
            ->where('order_id', $bookingOrderId)
            ->firstOrFail();

        return redirect('/search?order_id=' . $booking->id)->with('message', 'We are having difficulties to process your payment. Please create your booking again!');
    }

    public function completed(Request $request)
    {
        $this->midtransService->initPaymentGateway();
        if ($request->query('id')) {
            $transaction = Transaction::status($request->query('id'));
            $order_id = $transaction->order_id;
            $transaction_status = $transaction->transaction_status;
        } else {
            $response = preg_replace('/\\\\/', '', $request->response);
            $decoded_response = json_decode($response);
            $order_id = $decoded_response->order_id;
            $transaction_status = $decoded_response->transaction_status;
        }

        $booking = Booking::query()
            ->where('order_id', $order_id)
            ->firstOrFail();

        if ($transaction_status === 'deny') {
            $alertMessage = 'Something went wrong, please retry payment!';

            if ($booking->paymentStatus === 'FULL_PAYMENT_PENDING') {
                $paymentCode = 'ALL';
                $grossAmount = $booking->totalprice;

            } elseif ($booking->paymentStatus === 'DOWN_PAYMENT_PENDING') {
                $paymentCode = 'DP';
                $grossAmount = $booking->downPayment;

            } elseif ($booking->paymentStatus === 'INSTALLMENT_PENDING') {
                $paymentCode = 'INS';
                $grossAmount = $booking->installment;
            }

            $order_id = $paymentCode . '/' . '000' . random_int(1000, 9999);
            $booking->order_id = $order_id;
            $booking->update();

            $this->createInstallmentTransaction($booking, $grossAmount);
        } else {
            if ($booking->paymentStatus === 'FULL_PAYMENT_PENDING') {
                $alertType = 'danger';
                $alertMessage = 'Please Complete Payment!';

            } else if ($booking->paymentStatus === 'FULLY_PAID') {
                $alertType = 'message';
                $alertMessage = 'Payment Complete!';

            } else if ($booking->paymentStatus === 'DOWN_PAYMENT_PENDING') {
                $alertType = 'danger';
                $alertMessage = 'Please Complete Down Payment!';

            } else if ($booking->paymentStatus === 'DOWN_PAYMENT_PAID') {
                $alertType = 'message';
                $alertMessage = 'Down Payment Paid!';
                $paymentCode = 'INS';
                $order_id = $paymentCode . '/' . '000' . random_int(1000, 9999);
                $grossAmount = $booking->installment;
                $booking->order_id = $order_id;
                $booking->update();

                $this->createInstallmentTransaction($booking, $grossAmount);

            } else if ($booking->paymentStatus === 'INSTALLMENT_PENDING') {
                $alertType = 'danger';
                $alertMessage = 'Please Complete Installment Payment!';

            } else if ($booking->paymentStatus === 'INSTALLMENT_PAID') {
                $alertType = 'message';
                $alertMessage = 'Installment Paid! Payment Complete!';
            }
        }

        return redirect('/search?order_id=' . $booking->id)->with($alertType, $alertMessage);
    }

    public function unfinished(Request $request)
    {
        $this->midtransService->initPaymentGateway();
        if ($request->query('id')) {
            $transaction = Transaction::status($request->query('id'));
            $order_id = $transaction->order_id;
        } else {
            $response = preg_replace('/\\\\/', '', $request->response);
            $decoded_response = json_decode($response);
            $order_id = $decoded_response->order_id;
        }

        $booking = Booking::query()
            ->where('order_id', $order_id)
            ->firstOrFail();

        return redirect('/search?order_id=' . $booking->id)->with('message', 'Payment Not Complete!');
    }

    public function failed(Request $request)
    {
        $this->midtransService->initPaymentGateway();
        if ($request->query('id')) {
            $transaction = Transaction::status($request->query('id'));
            $order_id = $transaction->order_id;
        } else {
            $response = preg_replace('/\\\\/', '', $request->response);
            $decoded_response = json_decode($response);
            $order_id = $decoded_response->order_id;
        }

        $booking = Booking::query()
            ->where('order_id', $order_id)
            ->firstOrFail();

        return redirect('/search?order_id=' . $booking->id)->with('message', 'We are having difficulties to process your payment. Please create your booking again!');
    }
}
