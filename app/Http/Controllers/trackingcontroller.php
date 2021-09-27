<?php

namespace App\Http\Controllers;

use App\Models\additionals;
use App\Models\Booking;
use App\Models\status;
use Illuminate\Http\Request;

class trackingcontroller extends Controller
{

    public function index()
    {
        return view('pages.track.search');
    }

    public function post(Request $request)
    {
        $booking = Booking::query()
            ->where('order_id', $request->order_id)
            ->firstOrFail();

        $additionals = null;
        if ($booking->additionals !== null) {
            $additionals = additionals::query()
                ->whereIn('id', json_decode($booking->additionals))
                ->get();
        }

        $status = status::query()
            ->where('booking_id', $booking->id)
            ->first();

        return view('pages.track.trackbook', compact('booking', 'status', 'additionals'));
    }
}
