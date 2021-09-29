<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photobook;
use Illuminate\Http\Request;

class PhotobookController extends Controller
{
    public function index()
    {
        $photobooks = Photobook::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.features.photo_book.index', compact('photobooks'));
    }

    public function create()
    {
        return view('pages.admin.features.photo_book.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $photobook = new Photobook();
        $photobook->fill($validateData);
        $photobook->save();

        return redirect()->route('admin.photobook.index')->with('message', 'Photobook Added!');
    }

    public function edit(Photobook $photobook)
    {
        return view('pages.admin.features.photo_book.edit', compact('photobook'));
    }

    public function update(Request $request, Photobook $photobook)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $photobook->fill($validateData);
        $photobook->update();

        return redirect()->route('admin.photobook.index')->with('message', 'Photobook Updated!');
    }

    public function destroy(Photobook $photobook)
    {
        $photobook->delete();
        return redirect()->route('admin.photobook.index')->with('danger', 'Photobook Deleted!');
    }
}
