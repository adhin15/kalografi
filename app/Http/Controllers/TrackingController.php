<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Booking;
use App\Models\Status;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;

class TrackingController extends Controller
{

    public function index()
    {
        return view('pages.track.search');
    }

    public function post(Request $request)
    {
        try {
            $booking = Booking::query()
                ->where('order_id', $request->order_id)
                ->firstOrFail();

            $additionals = null;
            if ($booking->additionals !== null) {
                $additionals = Additional::query()
                    ->whereIn('id', json_decode($booking->additionals))
                    ->get();
            }

            $status = Status::query()
                ->where('booking_id', $booking->id)
                ->first();

            return view('pages.track.trackbook', compact('booking', 'status', 'additionals'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('message', 'Order Not Found!');
        }
    }
    public function postreview(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'comment' => 'required'
        ]);

        $review = new Review();
        $review->status = 1;
        $review->fill($validateData);
        $review->save();

        return redirect()->back()->with('message', 'Review Added!');
    }
}
