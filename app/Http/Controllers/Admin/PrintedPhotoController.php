<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\printedphoto;
use Illuminate\Http\Request;

class PrintedPhotoController extends Controller
{
    public function index()
    {
        $printedphotos = printedphoto::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.features.printed_photo.index', compact('printedphotos'));
    }

    public function create()
    {
        return view('pages.admin.features.printed_photo.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'printedphoto' => 'required',
            'price' => 'required|numeric'
        ]);

        $printedphoto = new printedphoto();
        $printedphoto->fill($validateData);
        $printedphoto->save();

        return redirect()->route('admin.printedphoto.index')->with('message', 'Printed Photo Added!');
    }

    public function edit(printedphoto $printedphoto)
    {
        return view('pages.admin.features.printed_photo.edit', compact('printedphoto'));
    }

    public function update(Request $request, printedphoto $printedphoto)
    {
        $validateData = $request->validate([
            'printedphoto' => 'required',
            'price' => 'required|numeric'
        ]);

        $printedphoto->fill($validateData);
        $printedphoto->update();

        return redirect()->route('admin.printedphoto.index')->with('message', 'Printed Photo Updated!');
    }

    public function destroy(printedphoto $printedphoto)
    {
        $printedphoto->delete();
        return redirect()->route('admin.printedphoto.index')->with('danger', 'Printed Photo Deleted!');
    }
}
