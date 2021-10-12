<?php

namespace App\Http\Controllers;

use App\Http\Services\MidtransService;
use App\Models\Booking;
use Illuminate\Http\Request;

class MidtransSnapController extends Controller
{
    private $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function snapFinish(Request $request)
    {
        $bookingOrderId = $request->order_id;
        $booking = Booking::query()
            ->where('order_id', $bookingOrderId)
            ->firstOrFail();
        $alertType = 'danger';
        $alertMessage = 'Something is wrong...';

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

        return redirect('/search?order_id=' . $booking->order_id)->with($alertType, $alertMessage);
    }

    public function snapUnfinished(Request $request)
    {
        $bookingOrderId = $request->query('order_id');
        $booking = Booking::query()
            ->where('order_id', $bookingOrderId)
            ->firstOrFail();

        return redirect('/search?order_id=' . $booking->order_id)->with('message', 'Payment Not Complete!');
    }

    public function snapFailed(Request $request)
    {
        $bookingOrderId = $request->order_id;
        $booking = Booking::query()
            ->where('order_id', $bookingOrderId)
            ->firstOrFail();

        return redirect('/search?order_id=' . $booking->order_id)->with('message', 'We are having difficulties to process your payment. Please create your booking again!');
    }
}
