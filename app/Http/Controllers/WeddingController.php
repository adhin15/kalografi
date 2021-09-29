<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Image;
use App\Models\Photobook;
use App\Models\Printedphoto;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class WeddingController extends Controller
{
    public function index(Request $request)
    {

        $booking = $request->session()->get('booking');
        $package = Package::all();
        return view('pages.pricelist.wedding.index', compact('package', 'booking'));
    }
}
