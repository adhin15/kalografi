<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\additional;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('pages.admin.dashboard');
    }

    public function search()
    {
        return view('pages.admin.search');
    }

    public function searchResult(Request $request)
    {
        $booking = Booking::query()
            ->where('order_id', $request->order_id)
            ->firstOrFail();

        $status = Status::query()
            ->where('booking_id', $booking->id)
            ->first();

        $additionals = null;
        if ($booking->additionals !== null) {
            $additionals = additional::query()
                ->whereIn('id', json_decode($booking->additionals))
                ->get();
        }

        return view('pages.admin.search-result', compact('booking', 'status', 'additionals'));
    }

    public function update(Request $request)
    {
        $bookingId = $request->bookingid;
        $status = Status::query()->findOrFail($bookingId);
        $status->current_status = $request->status_value;
        $status->update();

        return redirect()->back()->with('message', 'Booking Status Updated!');
    }
}
