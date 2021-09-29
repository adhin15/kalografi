<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Package;

class BookingController extends Controller
{
    public function home()
    {
        session()->forget('booking');
        return view('pages.landing.index');
    }

    public function prewedding(Request $request)
    {
        $booking = $request->session()->get('booking');
        $package = Package::all();
        return view('pages.pricelist.pre-wedding.index', compact('package', 'booking'));
    }
    public function engagement(Request $request)
    {
        $booking = $request->session()->get('booking');
        $package = Package::all();
        return view('pages.pricelist.engagement.index', compact('package', 'booking'));
    }

    public function orderfirststep(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => 'required',
        ]);

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->fill([
                'package_id' => $validatedData['package_id'],
            ]);
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->fill([
                'package_id' => $validatedData['package_id'],
            ]);
            $request->session()->put('booking', $booking);
        }
        return redirect('/pricelist/order');
    }
}
