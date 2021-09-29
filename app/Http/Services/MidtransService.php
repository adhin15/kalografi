<?php

namespace App\Http\Services;

use App\Models\Additional;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function initPaymentGateway()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_SANITIZED');
    }

    public function generatePaymentToken($booking)
    {
        $this->initPaymentGateway();

        $grossAmount = $booking->total_price;

        $additionalServices = null;
        if (session('booking')->additionals !== null) {
            $additionalServices = Additional::query()
                ->whereIn('id', json_decode($booking->additionals))
                ->get();
        }

        if ($booking->package_id) {
            $packageId = $booking->package->id;
            $packageName = $booking->package->name . ' ' . $booking->package->category;
            $packagePrice = $booking->package->price;
            $packageCategory = $booking->package->category;
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
            'id' => $booking->photobook->id,
            'name' => $booking->photobook->name,
            'price' => $booking->photobook->price,
            'quantity' => $booking->photobook_qty,
            'category' => 'Photo Book'
        ];

        $printedphotoDetails = [
            'id' => $booking->printedphoto->id,
            'name' => $booking->printedphoto->name,
            'price' => $booking->printedphoto->price,
            'quantity' => $booking->printedphoto_qty,
            'category' => 'Printed Photo'
        ];

        $initialPrice = $booking->total_price * (100 / (100 - $booking->discount->amount));
        $discountedPrice = ($initialPrice * $booking->discount->amount) / 100;

        $discountDetails = [
            'id' => $booking->discount_id,
            'name' => strtoupper($booking->discount->name) . ' (Discount)',
            'price' => -$discountedPrice,
            'quantity' => 1,
            'category' => 'Discount'
        ];

        $item_details = array($packageDetails, $printedphotoDetails, $photobookDetails, $discountDetails);

        if ($booking->payment_termination == 1) {
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

                $item_details = array_merge(array($packageDetails), array($printedphotoDetails), array($photobookDetails), $additionalDetails, array($discountDetails));
            }
        } else if ($booking->payment_termination == 2) {
            $grossAmount = $booking->down_payment;
            $downPaymentDetails = [
                'id' => 'DP',
                'name' => 'Down Payment Amount',
                'price' => -$booking->down_payment,
                'quantity' => 1,
                'category' => 'Down Payment'
            ];

            $item_details = $this->getItemDetailsWithAdditional($packageDetails, $printedphotoDetails, $photobookDetails, $discountDetails, $downPaymentDetails, $booking, $additionalServices);
        }

        $customerDetails = [
            'first_name' => $booking->full_name,
            'email' => $booking->email,
            'phone' => $booking->phone_number
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $booking->order_id,
                'gross_amount' => $grossAmount
            ],
            'item_details' => $item_details,
            'customer_details' => $customerDetails,
            'enable_payments' => Booking::PAYMENT_CHANNELS,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T', strtotime($booking->created_at)),
                'unit' => Booking::EXPIRY_UNIT,
                'duration' => Booking::EXPIRY_DURATION
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        if ($snapToken) {
            $booking->payment_token = $snapToken;
            $booking->save();
        }

        return $booking;
    }

    public function createInstallmentTransaction($booking, $grossAmount)
    {
        $this->initPaymentGateway();

        $additionalServices = null;
        if ($booking->additionals !== null) {
            $additionalServices = Additional::query()
                ->whereIn('id', json_decode($booking->additionals))
                ->get();
        }

        if ($booking->package_id) {
            $packageId = $booking->package->id;
            $packageName = $booking->package->name . ' ' . $booking->package->category;
            $packagePrice = $booking->package->price;
            $packageCategory = $booking->package->category;
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
            'id' => $booking->photobook->id,
            'name' => $booking->photobook->name,
            'price' => $booking->photobook->price,
            'quantity' => $booking->photobook_qty,
            'category' => 'Photo Book'
        ];

        $printedphotoDetails = [
            'id' => $booking->printedphoto->id,
            'name' => $booking->printedphoto->name,
            'price' => $booking->printedphoto->price,
            'quantity' => $booking->printedphoto_qty,
            'category' => 'Printed Photo'
        ];

        $initialPrice = $booking->total_price * (100 / (100 - $booking->discount->amount));
        $discountedPrice = ($initialPrice * $booking->discount->amount) / 100;

        $discountDetails = [
            'id' => $booking->discount_id,
            'name' => strtoupper($booking->discount->name) . ' (Discount)',
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

        $item_details = $this->getItemDetailsWithAdditional($packageDetails, $printedphotoDetails, $photobookDetails, $discountDetails, $installmentDetails, $booking, $additionalServices);

        $customerDetails = [
            'first_name' => $booking->full_name,
            'email' => $booking->email,
            'phone' => $booking->phone_number
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
            $booking->payment_token = $snapToken;
            $booking->save();
        }

        return $booking;
    }

    /**
     * @param array $packageDetails
     * @param array $printedphotoDetails
     * @param array $photobookDetails
     * @param array $discountDetails
     * @param array $downPaymentDetails
     * @param $booking
     * @param $additionalServices
     * @return array|array[]
     */
    public function getItemDetailsWithAdditional(array $packageDetails, array $printedphotoDetails, array $photobookDetails, array $discountDetails, array $downPaymentDetails, $booking, $additionalServices): array
    {
        $item_details = array($packageDetails, $printedphotoDetails, $photobookDetails, $discountDetails, $downPaymentDetails);

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

            $item_details = array_merge(array($packageDetails), array($printedphotoDetails), array($photobookDetails), $additionalDetails, array($discountDetails), array($downPaymentDetails));
        }
        return $item_details;
    }
}
