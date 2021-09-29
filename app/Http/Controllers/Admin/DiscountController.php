<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function index()
    {
        $discounts = Discount::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.discount.index', compact('discounts'));
    }


    public function create()
    {
        return view('pages.admin.discount.create');
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        $discount = new Discount();
        $discount->fill($validateData);
        $discount->save();

        return redirect()->route('admin.discount.index')->with('message', 'Discount Added!');
    }


    public function edit(discount $discount)
    {
        return view('pages.admin.discount.edit', compact('discount'));
    }


    public function update(Request $request, discount $discount)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric'
        ]);

        $discount->fill($validateData);
        $discount->update();

        return redirect()->route('admin.discount.index')->with('message', 'Discount Updated!');
    }


    public function destroy(discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discount.index')->with('danger', 'Discount Deleted!');
    }
}
