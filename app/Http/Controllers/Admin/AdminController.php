<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Paket;
use App\Models\status;
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
        $booking = Booking::query()->findOrFail($request->order_id);
        $status = status::query()->where('booking_id', $booking->id)->first();
        $package = Paket::all();

        return view('pages.admin.search-result', compact('booking', 'status', 'package'));
    }

    public function update(Request $request)
    {
        $bookingId = $request->bookingid;
        $status = status::query()->findOrFail($bookingId);
        $status->current_status = $request->status_value;
        $status->update();

        return redirect()->back()->with('message', 'Booking Status Updated!');
    }
}
