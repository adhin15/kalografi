<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workhour;

class WorkhourController extends Controller
{
    public function index()
    {
        $workhour = Workhour::query()->orderBy('id', 'DESC')->get();

        return view('pages.admin.features.workhours.index', compact('workhour'));
    }

    public function create()
    {
        return view('pages.admin.features.workhours.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'amount' => 'required',
            'price' => 'required|numeric'
        ]);

        $workhour = new Workhour();
        $workhour->fill($validateData);
        $workhour->save();

        return redirect()->route('admin.workhours.index')->with('message', 'Workhours Added!');
    }

    public function edit(Workhour $workhour)
    {

        return view('pages.admin.features.workhours.edit', compact('workhour'));
    }

    public function update(Request $request, Workhour $workhour)
    {
        $validateData = $request->validate([
            'amount' => 'required',
            'price' => 'required|numeric'
        ]);

        $workhour->fill($validateData);
        $workhour->update();

        return redirect()->route('admin.workhours.index')->with('message', 'Workhours Updated!');
    }

    public function destroy(Workhour $workhour)
    {
        $workhour->delete();
        return redirect()->route('admin.workhours.index')->with('danger', 'Workhours Deleted!');
    }
}
