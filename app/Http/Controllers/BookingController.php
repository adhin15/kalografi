<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Review;

class BookingController extends Controller
{
    public function home()
    {
        session()->forget('booking');
        $review = Review::latest()->take(5)->where('status', 2)->get();
        return view('pages.landing.index', compact('review'));
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
