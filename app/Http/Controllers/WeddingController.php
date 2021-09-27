<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\galeri;
use App\Models\photobook;
use App\Models\printedphoto;
use App\Models\Paket;
use Illuminate\Support\Facades\DB;

class WeddingController extends Controller
{
    public function index(Request $request)
    {

        $booking = $request->session()->get('booking');
        $package = Paket::all();
        return view('pages.pricelist.wedding.index', compact('package', 'booking'));
    }
}
