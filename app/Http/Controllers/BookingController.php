<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\galeri;
use App\Models\photobook;
use App\Models\printedphoto;

class BookingController extends Controller
{

    public function home()
    {
        session()->forget('booking');
        return view('pages.landing.index');
    }
    public function index()
    {
        return view('postpackage');
    }


    public function create(Request $request)
    {
        $name_one = $request->file('image_one')->getClientOriginalName();
        $name_two = $request->file('image_two')->getClientOriginalName();
        $name_three = $request->file('image_three')->getClientOriginalName();

        $request->file('image_one')->storeAs('public/assets/product', $name_one);
        $request->file('image_two')->storeAs('public/assets/product', $name_two);
        $request->file('image_three')->storeAs('public/assets/product', $name_three);

        $save = new galeri;

        $save->image_one = $name_one;
        $save->image_two = $name_two;
        $save->image_three = $name_three;
        $save->save();

        $package = new Paket();
        $package->namapaket = $request->namapaket;
        $package->kategori = $request->kategori;
        $package->workhours = $request->workhours;
        $package->day = $request->day;
        $package->photographers = $request->photographers;
        $package->videographers = $request->videographers;
        $package->flashdisk = $request->flashdisk;
        $package->edited = $request->edited;
        $package->price = $request->price;
        $package->idgaleri = $save->id;

        $package->save();

        return redirect('home');
    }

    public function prewedding(Request $request)
    {
        $booking = $request->session()->get('booking');
        $package = Paket::all();
        return view('pages.pricelist.pre-wedding.index', compact('package', 'booking'));
    }
    public function engagement(Request $request)
    {
        $booking = $request->session()->get('booking');
        $package = Paket::all();
        return view('pages.pricelist.engagement.index', compact('package', 'booking'));
    }

    public function orderfirststep(Request $request)
    {
        $validatedData = $request->validate([
            'paket_id' => 'required',
        ]);

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->fill([
                'paket_id' => $validatedData['paket_id'],
            ]);
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->fill([
                'paket_id' => $validatedData['paket_id'],
            ]);
            $request->session()->put('booking', $booking);
        }
        return redirect('/pricelist/order');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
