<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
    public function dashboard()
    {
        $booking = Booking::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.dashboard', compact('booking'));
    }

    public function search()
    {
        return view('pages.admin.search');
    }

    public function searchResult(Request $request)
    {
        try {
            $booking = Booking::query()
                ->where('order_id', $request->order_id)
                ->firstOrFail();

            $status = Status::query()
                ->where('booking_id', $booking->id)
                ->first();

            $additionals = null;
            if ($booking->additionals !== null) {
                $additionals = Additional::query()
                    ->whereIn('id', json_decode($booking->additionals))
                    ->get();
            }

            return view('pages.admin.search-result', compact('booking', 'status', 'additionals'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('message', 'Order Not Found!');
        }
    }

    public function update(Request $request)
    {
        $bookingId = $request->bookingid;
        $status = Status::query()->where('booking_id', $bookingId)->first();
        $status->current_status = $request->status_value;
        $status->update();


        return redirect()->back()->with('message', 'Booking Status Updated!');
    }
}
