<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    public function index()
    {
        $additionals = Additional::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.features.additionals.index', compact('additionals'));
    }

    public function create()
    {
        return view('pages.admin.features.additionals.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $additionals = new Additional();
        $additionals->fill($validateData);
        $additionals->save();

        return redirect()->route('admin.additional.index')->with('message', 'Additional Service Added!');
    }

    public function edit(Additional $additional)
    {
        return view('pages.admin.features.additionals.edit', compact('additional'));
    }

    public function update(Request $request, Additional $additional)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $additional->fill($validateData);
        $additional->update();

        return redirect()->route('admin.additional.index')->with('message', 'Additional Service Updated!');
    }

    public function destroy(Additional $additional)
    {
        $additional->delete();
        return redirect()->route('admin.additional.index')->with('danger', 'Additional Service Deleted!');
    }
}
