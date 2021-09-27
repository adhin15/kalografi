<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\galeri;
use App\Models\Paket;
use App\Models\photographers;
use App\Models\videographers;
use App\Models\workhours;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Paket::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $workHours = workhours::all();
        $photoGraphers = photographers::all();
        $videoGraphers = videographers::all();
        return view('pages.admin.packages.create', compact('workHours', 'photoGraphers', 'videoGraphers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namapaket' => 'required',
            'kategori' => 'required',
            'workhour_id' => 'required',
            'day' => 'required',
            'photographer_id' => 'required',
            'videographer_id' => 'required',
            'flashdisk' => 'required',
            'edited' => 'required',
            'price' => 'required|numeric',
            'image_one' => 'required|image',
            'image_two' => 'required|image',
            'image_three' => 'required|image',
        ]);

        $name_one = $request->file('image_one')->getClientOriginalName();
        $name_two = $request->file('image_two')->getClientOriginalName();
        $name_three = $request->file('image_three')->getClientOriginalName();

        $request->file('image_one')->storeAs('public/assets/product', $name_one);
        $request->file('image_two')->storeAs('public/assets/product', $name_two);
        $request->file('image_three')->storeAs('public/assets/product', $name_three);

        $galeri = galeri::query()->create([
            'image_one' => $name_one,
            'image_two' => $name_two,
            'image_three' => $name_three
        ]);

        Paket::query()->create([
            'idgaleri' => $galeri->id,
            'photographer_id' => $request->photographer_id,
            'videographer_id' => $request->videographer_id,
            'workhour_id' => $request->workhour_id,
            'namapaket' => $request->namapaket,
            'kategori' => $request->kategori,
            'day' => $request->day,
            'flashdisk' => $request->flashdisk,
            'edited' => $request->edited,
            'price' => $request->price
        ]);

        return redirect()->route('admin.paket.index')->with('message', 'Package Added!');
    }

    public function edit(Paket $paket)
    {
        $workHours = workhours::all();
        $photoGraphers = photographers::all();
        $videoGraphers = videographers::all();
        return view('pages.admin.packages.edit', compact('paket', 'workHours', 'photoGraphers', 'videoGraphers'));
    }

    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'namapaket' => 'required',
            'kategori' => 'required',
            'workhour_id' => 'required',
            'day' => 'required',
            'photographer_id' => 'required',
            'videographer_id' => 'required',
            'flashdisk' => 'required',
            'edited' => 'required',
            'price' => 'required|numeric',
        ]);

        $galeri = galeri::query()->findOrFail($paket->idgaleri);

        if ($request->hasFile('image_one')) {
            $name_one = $request->file('image_one')->getClientOriginalName();
            $request->file('image_one')->storeAs('public/assets/product', $name_one);
        } else {
            $name_one = $galeri->image_one;
        }

        if ($request->hasFile('image_two')) {
            $name_two = $request->file('image_two')->getClientOriginalName();
            $request->file('image_two')->storeAs('public/assets/product', $name_two);
        } else {
            $name_two = $galeri->image_two;
        }

        if ($request->hasFile('image_three')) {
            $name_three = $request->file('image_three')->getClientOriginalName();
            $request->file('image_three')->storeAs('public/assets/product', $name_three);
        } else {
            $name_three = $galeri->image_three;
        }

        galeri::query()->findOrFail($paket->idgaleri)->update([
            'image_one' => $name_one,
            'image_two' => $name_two,
            'image_three' => $name_three
        ]);

        $paket->update([
            'photographer_id' => $request->photographer_id,
            'videographer_id' => $request->videographer_id,
            'workhour_id' => $request->workhour_id,
            'namapaket' => $request->namapaket,
            'kategori' => $request->kategori,
            'day' => $request->day,
            'flashdisk' => $request->flashdisk,
            'edited' => $request->edited,
            'price' => $request->price
        ]);

        return redirect()->route('admin.paket.index')->with('message', 'Package Updated!');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index')->with('danger', 'Package Deleted!');
    }
}
