<?php

namespace App\Http\Controllers;

use App\Http\Services\MidtransService;
use App\Models\Additional;
use App\Models\Booking;
use App\Models\Custom;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Package;
use App\Models\Photobook;
use App\Models\Photographer;
use App\Models\Printedphoto;
use App\Models\Status;
use App\Models\Videographer;
use App\Models\Workhour;
use Illuminate\Http\Request;

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
        $printedphoto = Printedphoto::all();
        $photobook = Photobook::all();
        $package = Package::query()->where('id', $booking->package_id)->first();
        $additionals = Additional::all();
        $image = Image::query()->where('id', $package->image_id)->first();

        return view('pages.pricelist.order.order', compact('printedphoto', 'photobook', 'package', 'image', 'additionals'));
    }

    //SECOND STEP OF BOOKING
    //PICK DATE, PHOTOBOOK, AND PRINTED PHOTO
    //STORE TO SESSION('BOOKING')
    //URL: /pricelist/postorder
    public function postCreateStep1(Request $request)
    {
        $additionalsjson = null;

        $request->validate([
            'package_id' => 'required',
            'book_date' => 'required',
            'printedphoto_id' => 'required',
            'printedphoto_qty' => 'required',
            'photobook_id' => 'required',
            'photobook_qty' => 'required',
        ]);

        $packageprice = Package::query()
            ->where('id', $request->package_id)
            ->value('price');

        $printedphotoprice = Printedphoto::query()
            ->where('id', $request->printedphoto_id)
            ->value('price') * $request->printedphoto_qty;

        $photobookprice = Photobook::query()
            ->where('id', $request->photobook_id)
            ->value('price') * $request->photobook_qty;

        $totalprice = $packageprice + $printedphotoprice + $photobookprice;

        if (!empty($request->additionals)) {
            $additionals = $request->additionals;
            $additionalsjson = json_encode($additionals);
            $additionalPrice = 0;

            foreach ($additionals as $item) {
                $additionalData = Additional::query()->where('id', $item)->value('price');
                $additionalPrice += $additionalData;
            }

            $totalprice = $packageprice + $printedphotoprice + $photobookprice + $additionalPrice;
        }

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->additionals = $additionalsjson;
            $booking->fill([
                'package_id' => $request->package_id,
                'book_date' => $request->book_date,
                'printedphoto_id' => $request->printedphoto_id,
                'printedphoto_qty' => $request->printedphoto_qty,
                'photobook_id' => $request->photobook_id,
                'photobook_qty' => $request->photobook_qty,
                'total_price' => $totalprice
            ]);
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->additionals = $additionalsjson;
            $booking->fill([
                'package_id' => $request->package_id,
                'book_date' => $request->book_date,
                'printedphoto_id' => $request->printedphoto_id,
                'printedphoto_qty' => $request->printedphoto_qty,
                'photobook_id' => $request->photobook_id,
                'photobook_qty' => $request->photobook_qty,
                'total_price' => $totalprice
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
        if (session()->has('booking')) {
            $additionals = null;
            if (session('booking')->additionals !== null) {
                $additionals = Additional::query()
                    ->whereIn('id', json_decode(session('booking')->additionals))
                    ->get();
            }

            $booking = $request->session()->get('booking');
            $package = Package::query()->where('id', $booking->package_id)->first();
            $pp = Printedphoto::query()->where('id', $booking->printedphoto_id)->first();
            $pb = Photobook::query()->where('id', $booking->photobook_id)->first();
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
            'wedding_style' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
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
        if (session()->has('booking')) {
            $additionals = null;
            if (session('booking')->additionals !== null) {
                $additionals = Additional::query()
                    ->whereIn('id', json_decode(session('booking')->additionals))
                    ->get();
            }

            $discount = Discount::all();
            $booking = $request->session()->get('booking');
            $package = Package::query()->where('id', $booking->package_id)->first();
            $pp = Printedphoto::query()->where('id', $booking->printedphoto_id)->first();
            $pb = Photobook::query()->where('id', $booking->photobook_id)->first();

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
        $discountPrice = 0;
        $booking = $request->session()->get('booking');
        $customSession = $request->session()->get('custom');

        if ($request->discount_id != 0) {
            $discount = Discount::query()
                ->where('id', $request->discount_id)
                ->value('amount');
            $discountAmountToInt = (int)$discount;
            $discountPrice = $booking->total_price * $discountAmountToInt / 100;
        }

        $totalPrice = $booking->total_price - $discountPrice;

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
        $booking->total_price = $totalPrice;
        $booking->discount_id = $request->discount_id;
        $booking->down_payment = $downPayment;
        $booking->installment = $installment;
        $booking->payment_status = 'CREATED';

        if ($booking->package_id == 0) {
            //CUSTOMNYA NGEBUG???? HERAN
            //PAS $custom->save() DIA GA NGESAVE KE TABLE CUSTOM?????
            //ERROR GEGARA ITU BOOKINGNYA MINTA custom_id TAPI BELUM ADA CUSTOMNYA
            $custom = Custom::query()->create([
                'photographer_id' => $customSession->photographer_id,
                'videographer_id' => $customSession->videographer_id,
                'workhour_id' => $customSession->workhour_id,
                'price' => $customSession->price,
            ]);
            $booking->package_id = null;
            $booking->custom_id = $custom->id;
        }

        //CREATE NEW RECORD OF BOOKING FROM THE SESSION DATA
        $booking->save();

        //CREATE PAYMENT TOKEN
        $this->midtransService->generatePaymentToken($booking);

        Status::query()->create([
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

        $additionals = null;
        if ($booking->additionals !== null) {
            $additionals = Additional::query()
                ->whereIn('id', json_decode($booking->additionals))
                ->get();
        }

        return view('pages.pricelist.order.payment', compact('booking', 'additionals'));
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
        $photographers = Photographer::all();
        $videographers = Videographer::all();
        $workhours = Workhour::all();
        $printedphoto = Printedphoto::all();
        $photobook = Photobook::all();
        $additionals = Additional::all();

        return view(
            'pages.custom.customisation',
            compact(
                'printedphoto',
                'photobook',
                'product',
                'additionals',
                'photographers',
                'videographers',
                'workhours'
            )
        );
    }

    //CREATE BOOKING FOR CUSTOM PACKAGE
    public function postcustom(Request $request)
    {
        $additionalJson = null;

        $photographerPrice = Photographer::query()
            ->where('id', $request->photographer_id)
            ->value('price');

        $videographerPrice = Videographer::query()
            ->where('id', $request->videographer_id)
            ->value('price');

        $workhourPrice = Workhour::query()
            ->where('id', $request->workhour_id)
            ->value('price');

        $printedPhotoPrice = Printedphoto::query()
            ->where('id', $request->printedphoto_id)
            ->value('price');

        $photobookPrice = Photobook::query()
            ->where('id', $request->photobook_id)
            ->value('price');

        $printedPhotoQty = $request->printedphoto_qty;
        $photobookQty = $request->photobook_qty;

        $printedPhotoTotal = $printedPhotoPrice * $printedPhotoQty;
        $photobookTotal = $photobookPrice * $photobookQty;
        $packagePrice = $photographerPrice + $videographerPrice + $workhourPrice;
        $totalPrice = $packagePrice + $printedPhotoTotal + $photobookTotal;

        if (!empty($request->additionals)) {
            $additionals = $request->additionals;
            $additionalJson = json_encode($additionals);
            $additionalPrice = 0;

            foreach ($additionals as $additional) {
                $additionalData = Additional::query()->where('id', $additional)->value('price');
                $additionalPrice += $additionalData;
            }

            $totalPrice = $packagePrice + $printedPhotoTotal + $photobookTotal + $additionalPrice;
        }

        $validatedDataCustom = $request->validate([
            'photographer_id' => 'required',
            'videographer_id' => 'required',
            'workhour_id' => 'required',
        ]);

        if (empty($request->session()->get('custom'))) {
            $custom = new Custom();
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
            'package_id' => 'required',
            'book_date' => 'required',
            'printedphoto_id' => 'required',
            'printedphoto_qty' => 'required',
            'photobook_id' => 'required',
            'photobook_qty' => 'required',
        ]);

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->fill($validatedData);
            $booking->additionals = $additionalJson;
            $booking->total_price = $totalPrice;
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->fill($validatedData);
            $booking->additionals = $additionalJson;
            $booking->total_price = $totalPrice;
            $request->session()->put('booking', $booking);
        }

        return redirect('pricelist/order/details');
    }
}
