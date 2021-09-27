<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\galeri;
use App\Models\Paket;
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
        return view('pages.admin.packages.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'namapaket' => 'required',
            'kategori' => 'required',
            'workhours' => 'required|numeric',
            'day' => 'required',
            'photographers' => 'required',
            'videographers' => 'required',
            'flashdisk' => 'required',
            'edited' => 'required',
            'price' => 'required|numeric',
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
          'image_three' => $name_three,
        ]);

        $paket = new Paket();
        $paket->fill($validateData);
        $paket->idgaleri = $galeri->id;
        $paket->save();

        return redirect()->route('admin.paket.index')->with('danger', 'Package Added!');
    }

    public function edit(Paket $paket)
    {
        return view('pages.admin.packages.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $validateData = $request->validate([
            'namapaket' => 'required',
            'kategori' => 'required',
            'workhours' => 'required|numeric',
            'day' => 'required',
            'photographers' => 'required',
            'videographers' => 'required',
            'flashdisk' => 'required',
            'edited' => 'required',
            'price' => 'required|numeric',
        ]);

        $name_one = $request->file('image_one')->getClientOriginalName();
        $name_two = $request->file('image_two')->getClientOriginalName();
        $name_three = $request->file('image_three')->getClientOriginalName();

        $request->file('image_one')->storeAs('public/assets/product', $name_one);
        $request->file('image_two')->storeAs('public/assets/product', $name_two);
        $request->file('image_three')->storeAs('public/assets/product', $name_three);

        $galeri = galeri::query()->findOrFail($paket->idgaleri);
        $galeri->update([
            'image_one' => $name_one,
            'image_two' => $name_two,
            'image_three' => $name_three
        ]);

        $paket->fill($validateData);
        $paket->update();

        return redirect()->route('admin.paket.index')->with('danger', 'Package Updated!');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.paket.index')->with('danger', 'Package Deleted!');
    }
}
