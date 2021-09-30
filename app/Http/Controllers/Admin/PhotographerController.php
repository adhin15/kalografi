<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photographer;

class PhotographerController extends Controller
{
    public function index()
    {
        $photographer = Photographer::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.features.photographer.index', compact('photographer'));
    }

    public function create()
    {
        return view('pages.admin.features.photographer.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'amount' => 'required',
            'price' => 'required|numeric'
        ]);

        $photographer = new Photographer();
        $photographer->fill($validateData);
        $photographer->save();

        return redirect()->route('admin.photographer.index')->with('message', 'Photographer Added!');
    }

    public function edit(Photographer $photographer)
    {
        return view('pages.admin.features.photographer.edit', compact('photographer'));
    }

    public function update(Request $request, Photographer $photographer)
    {
        $validateData = $request->validate([
            'amount' => 'required',
            'price' => 'required|numeric'
        ]);

        $photographer->fill($validateData);
        $photographer->update();

        return redirect()->route('admin.photographer.index')->with('message', 'Photographer Updated!');
    }

    public function destroy(Photographer $photographer)
    {
        $photographer->delete();
        return redirect()->route('admin.photographer.index')->with('danger', 'Photographer Deleted!');
    }
}
