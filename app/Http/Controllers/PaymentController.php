<?php

namespace App\Http\Controllers;

use App\Http\Services\MidtransService;
use App\Models\Additional;
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
            if ($booking->payment_status === 'CREATED') {
                if ($booking->payment_termination == 1) {
                    $booking->payment_status = 'FULLY_PAID';
                } elseif ($booking->payment_termination == 2) {
                    $booking->payment_status = 'DOWN_PAYMENT_PAID';
                    $booking->installment = $booking->down_payment;
                    $booking->down_payment = null;
                }
            } elseif ($booking->payment_status === 'FULL_PAYMENT_PENDING') {
                $booking->payment_status = 'FULLY_PAID';
            } elseif ($booking->payment_status === 'DOWN_PAYMENT_PENDING') {
                $booking->payment_status = 'DOWN_PAYMENT_PAID';
                $booking->installment = $booking->down_payment;
                $booking->down_payment = null;
            } elseif ($booking->payment_status === 'DOWN_PAYMENT_PAID' || $booking->payment_status === 'INSTALLMENT_PENDING') {
                $booking->payment_status = 'INSTALLMENT_PAID';
                $booking->installment = null;
            }
        } elseif ($transactionStatus === 'pending') {
            if ($booking->payment_status === 'CREATED') {
                if ($booking->payment_termination == 1) {
                    $booking->payment_status = 'FULL_PAYMENT_PENDING';
                } elseif ($booking->payment_termination == 2) {
                    $booking->payment_status = 'DOWN_PAYMENT_PENDING';
                }
            } elseif ($booking->payment_status === 'DOWN_PAYMENT_PAID') {
                $booking->payment_status = 'INSTALLMENT_PENDING';
            }
        }

        $booking->update();

        return response('OK', 200);
    }

    public function completed(Request $request)
    {
        $this->midtransService->initPaymentGateway();

        $alertType = 'danger';
        $alertMessage = 'Something is wrong...';

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

            if ($booking->payment_status === 'FULL_PAYMENT_PENDING') {
                $paymentCode = 'ALL';
                $grossAmount = $booking->total_price;
            } elseif ($booking->payment_status === 'DOWN_PAYMENT_PENDING') {
                $paymentCode = 'DP';
                $grossAmount = $booking->down_payment;
            } elseif ($booking->payment_status === 'INSTALLMENT_PENDING') {
                $paymentCode = 'INS';
                $grossAmount = $booking->installment;
            }

            $order_id = $paymentCode . '/' . '000' . random_int(1000, 9999);
            $booking->order_id = $order_id;
            $booking->update();

            $this->midtransService->createInstallmentTransaction($booking, $grossAmount);
        } else {
            if ($booking->payment_status === 'FULL_PAYMENT_PENDING') {
                $alertType = 'danger';
                $alertMessage = 'Please Complete Payment!';
            } else if ($booking->payment_status === 'FULLY_PAID') {
                $alertType = 'message';
                $alertMessage = 'Payment Complete!';
            } else if ($booking->payment_status === 'DOWN_PAYMENT_PENDING') {
                $alertType = 'danger';
                $alertMessage = 'Please Complete Down Payment!';
            } else if ($booking->payment_status === 'DOWN_PAYMENT_PAID') {
                $alertType = 'info';
                $alertMessage = 'Down Payment Paid! Your Order ID Has Been Updated!';
                $paymentCode = 'INS';
                $order_id = $paymentCode . '/' . '000' . random_int(1000, 9999);
                $grossAmount = $booking->installment;
                $booking->order_id = $order_id;
                $booking->update();

                $this->midtransService->createInstallmentTransaction($booking, $grossAmount);
            } else if ($booking->payment_status === 'INSTALLMENT_PENDING') {
                $alertType = 'danger';
                $alertMessage = 'Please Complete Installment Payment!';
            } else if ($booking->payment_status === 'INSTALLMENT_PAID') {
                $alertType = 'message';
                $alertMessage = 'Installment Paid! Payment Complete!';
            }
        }

        return redirect('/search?order_id=' . $booking->order_id)->with($alertType, $alertMessage);
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

        return redirect('/search?order_id=' . $booking->order_id)->with('message', 'Payment Not Complete!');
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

        return redirect('/search?order_id=' . $booking->order_id)->with('message', 'We are having difficulties to process your payment. Please create your booking again!');
    }
}
