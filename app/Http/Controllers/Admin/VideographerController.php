<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Videographer;

class VideographerController extends Controller
{
    public function index()
    {
        $videographer = Videographer::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.features.videographer.index', compact('videographer'));
    }

    public function create()
    {
        return view('pages.admin.features.videographer.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'amount' => 'required',
            'price' => 'required|numeric'
        ]);

        $videographer = new Videographer();
        $videographer->fill($validateData);
        $videographer->save();

        return redirect()->route('admin.videographer.index')->with('message', 'Videographer Added!');
    }

    public function edit(Videographer $videographer)
    {
        dd($videographer);
        return view('pages.admin.features.videographer.edit', compact('videographer'));
    }

    public function update(Request $request, Videographer $videographer)
    {
        $validateData = $request->validate([
            'amount' => 'required',
            'price' => 'required|numeric'
        ]);

        $videographer->fill($validateData);
        $videographer->update();

        return redirect()->route('admin.videographer.index')->with('message', 'Videographer Updated!');
    }

    public function destroy(Videographer $videographer)
    {
        $videographer->delete();
        return redirect()->route('admin.videographer.index')->with('danger', 'Videographer Deleted!');
    }
}
