<?php

namespace App\Http\Controllers;

use App\Http\Services\MidtransService;
use App\Models\additionals;
use App\Models\galeri;
use App\Models\photographers;
use App\Models\videographers;
use App\Models\workhours;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Paket;
use App\Models\discount;
use App\Models\printedphoto;
use App\Models\photobook;
use App\Models\status;
use App\Models\custom;
use Midtrans\Snap;

class OrderController extends Controller
{
    private $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    //FIRST STEP OF BOOKING
    //SHOW ORDER PACKAGE FORM
    //URL: /pricelist/order
    public function orderpackage(Request $request)
    {
        $booking = $request->session()->get('booking');
        $printedphoto = printedphoto::all();
        $photobook = photobook::all();
        $package = Paket::query()->where('id', $booking->paket_id)->first();
        $additionals = additionals::all();
        $galeri = galeri::query()->where('id', $package->idgaleri)->first();

        return view('pages.pricelist.order.order', compact('printedphoto', 'photobook', 'package', 'galeri', 'additionals'));
    }

    //SECOND STEP OF BOOKING
    //PICK DATE, PHOTOBOOK, AND PRINTED PHOTO
    //STORE TO SESSION('BOOKING')
    //URL: /pricelist/postorder
    public function postCreateStep1(Request $request)
    {
        $additionals = $request->input('additionals');
        $additionalsjson = json_encode($additionals);
        $additionalPrice = 0;

        foreach ($additionals as $item) {
            $additionalData = additionals::query()->where('id', $item)->value('price');
            $additionalPrice += $additionalData;
        }

        $validatedData = $request->validate([
            'paket_id' => 'required',
            'bookdate' => 'required',
            'printedphoto_id' => 'required',
            'ppqty' => 'required',
            'photobook_id' => 'required',
            'pbqty' => 'required',
        ]);

        $packageprice = Paket::query()
            ->where('id', $request->paket_id)
            ->value('price');

        $printedphotoprice = printedphoto::query()
                ->where('id', $request->printedphoto_id)
                ->value('price') * $request->ppqty;

        $photobookprice = photobook::query()
                ->where('id', $request->photobook_id)
                ->value('price') * $request->pbqty;

        $totalprice = $packageprice + $printedphotoprice + $photobookprice + $additionalPrice;

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->additionals = $additionalsjson;
            $booking->fill([
                'paket_id' => $validatedData['paket_id'],
                'bookdate' => $validatedData['bookdate'],
                'printedphoto_id' => $validatedData['printedphoto_id'],
                'ppqty' => $validatedData['ppqty'],
                'photobook_id' => $validatedData['photobook_id'],
                'pbqty' => $validatedData['pbqty'],
                'totalprice' => $totalprice
            ]);
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->additionals = $additionalsjson;
            $booking->fill([
                'paket_id' => $validatedData['paket_id'],
                'bookdate' => $validatedData['bookdate'],
                'printedphoto_id' => $validatedData['printedphoto_id'],
                'ppqty' => $validatedData['ppqty'],
                'photobook_id' => $validatedData['photobook_id'],
                'pbqty' => $validatedData['pbqty'],
                'totalprice' => $totalprice
            ]);
            $request->session()->put('booking', $booking);
        }

        return redirect('/pricelist/order/details');
    }

    //THIRD STEP OF BOOKING
    //SHOW ORDER AND CUSTOMER DETAILS FORM
    //URL: /pricelist/order/details
    public function order(Request $request)
    {
        $additionals = additionals::query()
            ->whereIn('id', json_decode(session('booking')->additionals))
            ->get();

        if (session()->has('booking')) {
            $booking = $request->session()->get('booking');
            $package = Paket::query()->where('id', $booking->paket_id)->first();
            $pp = printedphoto::query()->where('id', $booking->printedphoto_id)->first();
            $pb = photobook::query()->where('id', $booking->photobook_id)->first();

        } else {
            return redirect('/');
        }

        return view('pages.pricelist.order.create', compact('booking', 'package', 'pp', 'pb', 'additionals'));
    }

    //FOURTH STEP OF BOOKING
    //ADD ORDER AND CUSTOMER DETAILS TO SESSION('BOOKING')
    //URL: /pricelist/details/order
    public function kirim(Request $request)
    {
        $validatedData = $request->validate([
            'venue' => 'required',
            'tone' => 'required',
            'weddingstyle' => 'required',
            'fullname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'address' => 'required',
            'discount_id' => 'nullable',
            'payment_termination' => 'nullable',
        ]);

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->fill($validatedData);
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->fill($validatedData);
            $request->session()->put('booking', $booking);
        }
        return redirect('/pricelist/order/checkout');
    }

    //FIFTH STEP OF BOOKING
    //SHOW CHECKOUT PAGE, PAYMENT DETAILS FORM
    //URL: /pricelist/order/checkout
    public function checkout(Request $request)
    {
        $additionals = additionals::query()
            ->whereIn('id', json_decode(session('booking')->additionals))
            ->get();

        if (session()->has('booking')) {
            $discount = discount::all();
            $booking = $request->session()->get('booking');
            $package = Paket::query()->where('id', $booking->paket_id)->first();
            $pp = printedphoto::query()->where('id', $booking->printedphoto_id)->first();
            $pb = photobook::query()->where('id', $booking->photobook_id)->first();
            return view('pages.pricelist.order.checkout', compact('booking', 'package', 'discount', 'pp', 'pb', 'additionals'));

        } else {
            return redirect('/');
        }
    }

    //SIXTH STEP OF BOOKING
    //STORE BOOKING TO DATABASE
    //URL: /pricelist/order/checkout/store
    public function store(Request $request)
    {
        $discount = discount::query()
            ->where('id', $request->discount)
            ->value('jumlah');
        $discountAmountToInt = (int)$discount;

        $booking = $request->session()->get('booking');
        $custom = $request->session()->get('custom');

        $discountPrice = $booking->totalprice * $discountAmountToInt / 100;
        $totalPrice = $booking->totalprice - $discountPrice;

        $downPayment = null;
        $installment = null;
        $paymentCode = 'ALL';

        if ($request->payment_termination == 2) {
            $downPayment = $totalPrice / 2;
            $installment = null;
            $paymentCode = 'DP';
        }

        $order_id = $paymentCode . '/' . '000' . random_int(1000, 9999);

        $booking->order_id = $order_id;
        $booking->payment_termination = $request->payment_termination;
        $booking->totalprice = $totalPrice;
        $booking->discount_id = $request->discount_id;
        $booking->downPayment = $downPayment;
        $booking->installment = $installment;
        $booking->paymentStatus = 'CREATED';

        if ($booking->paket_id == 0) {
            $custom->save();
            $booking->paket_id = null;
            $booking->custom_id = $custom->id;
        }

        //CREATE NEW RECORD OF BOOKING FROM THE SESSION DATA
        $booking->save();

        //CREATE PAYMENT TOKEN
        $this->_generatePaymentToken($booking);

        Status::create([
            'booking_id' => $booking->id
        ]);
        session()->forget('booking');
        return redirect()->route('payment.confirmation', $booking->id);
    }

    //SEVENTH STEP OF BOOKING
    //SHOW PAYMENT CONFIRMATION PAGE, WILL BE REDIRECTED TO DUMMY PAYMENT CONTROLLER
    //URL: /payment-confirmation
    public function payment($id)
    {
        $booking = Booking::query()->findOrFail($id);
        $additionals = additionals::query()
            ->whereIn('id', json_decode($booking->additionals))
            ->get();

        return view('pages.pricelist.order.payment', compact('booking', 'additionals'));
    }

    //GENERATE MIDTRANS PAYMENT TOKEN
    public function _generatePaymentToken($booking)
    {
        $this->midtransService->initPaymentGateway();

        $grossAmount = $booking->totalprice;

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
            $grossAmount = $booking->downPayment;
            $downPaymentDetails = [
                'id' => 'DP',
                'name' => 'Down Payment Amount',
                'price' => -$booking->downPayment,
                'quantity' => 1,
                'category' => 'Down Payment'
            ];

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
        }

        $customerDetails = [
            'first_name' => $booking->fullname,
            'email' => $booking->email,
            'phone' => $booking->phonenumber
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
            $booking->paymentToken = $snapToken;
            $booking->save();
        }

        return $booking;
    }

    public function postpaket()
    {
        $data = Booking::all();
        return view('pages.post', compact('data'));
    }

    //CREATE CUSTOM PACKAGE
    public function custom(Request $request)
    {
        $product = $request->session()->get('booking');
        $photographers = photographers::all();
        $videographers = videographers::all();
        $workhours = workhours::all();
        $printedphoto = printedphoto::all();
        $photobook = photobook::all();
        $additionals = additionals::all();

        return view('pages.custom.customisation',
            compact('printedphoto',
                'photobook',
                'product',
                'additionals',
                'photographers',
                'videographers',
                'workhours'));
    }

    //CREATE BOOKING FOR CUSTOM PACKAGE
    public function postcustom(Request $request)
    {
        $additionals = $request->additionals;
        $additionalJson = json_encode($additionals);
        $additionalPrice = 0;

        $photographerPrice = photographers::query()
            ->where('id', $request->photographer_id)
            ->value('price');

        $videographerPrice = videographers::query()
            ->where('id', $request->videographer_id)
            ->value('price');

        $workhourPrice = workhours::query()
            ->where('id', $request->workhour_id)
            ->value('price');

        $printedPhotoPrice = printedphoto::query()
            ->where('id', $request->printedphoto_id)
            ->value('price');

        $photobookPrice = photobook::query()
            ->where('id', $request->photobook_id)
            ->value('price');

        $printedPhotoQty = $request->ppqty;
        $photobookQty = $request->pbqty;

        foreach ($additionals as $additional) {
            $additionalData = additionals::query()
                ->where('id', $additional)
                ->value('price');
            $additionalPrice += $additionalData;
        }

        $printedPhotoTotal = $printedPhotoPrice * $printedPhotoQty;
        $photobookTotal = $photobookPrice * $photobookQty;
        $packagePrice = $photographerPrice + $videographerPrice + $workhourPrice;
        $totalPrice = $packagePrice + $printedPhotoTotal + $photobookTotal + $additionalPrice;

        $validatedDataCustom = $request->validate([
            'photographer_id' => 'required',
            'videographer_id' => 'required',
            'workhour_id' => 'required',
        ]);

        if (empty($request->session()->get('custom'))) {
            $custom = new custom();
            $custom->price = $packagePrice;
            $custom->fill($validatedDataCustom);
            $request->session()->put('custom', $custom);
        } else {
            $custom = $request->session()->get('custom');
            $custom->price = $packagePrice;
            $custom->fill($validatedDataCustom);
            $request->session()->put('custom', $custom);
        }

        $validatedData = $request->validate([
            'paket_id' => 'required',
            'bookdate' => 'required',
            'printedphoto_id' => 'required',
            'ppqty' => 'required',
            'photobook_id' => 'required',
            'pbqty' => 'required',
        ]);

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->fill($validatedData);
            $booking->additionals = $additionalJson;
            $booking->totalprice = $totalPrice;
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->fill($validatedData);
            $booking->additionals = $additionalJson;
            $booking->totalprice = $totalPrice;
            $request->session()->put('booking', $booking);
        }

        return redirect('pricelist/order/details');
    }
}
