<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Printedphoto;
use Illuminate\Http\Request;

class PrintedPhotoController extends Controller
{
    public function index()
    {
        $printedphotos = Printedphoto::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.features.printed_photo.index', compact('printedphotos'));
    }

    public function create()
    {
        return view('pages.admin.features.printed_photo.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $printedphoto = new Printedphoto();
        $printedphoto->fill($validateData);
        $printedphoto->save();

        return redirect()->route('admin.printedphoto.index')->with('message', 'Printed Photo Added!');
    }

    public function edit(Printedphoto $printedphoto)
    {
        return view('pages.admin.features.printed_photo.edit', compact('printedphoto'));
    }

    public function update(Request $request, Printedphoto $printedphoto)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $printedphoto->fill($validateData);
        $printedphoto->update();

        return redirect()->route('admin.printedphoto.index')->with('message', 'Printed Photo Updated!');
    }

    public function destroy(Printedphoto $printedphoto)
    {
        $printedphoto->delete();
        return redirect()->route('admin.printedphoto.index')->with('danger', 'Printed Photo Deleted!');
    }
}
