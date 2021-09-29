<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Package;
use App\Models\Photographer;
use App\Models\Videographer;
use App\Models\Workhour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::query()->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $workHours = Workhour::all();
        $photoGraphers = Photographer::all();
        $videoGraphers = Videographer::all();
        return view('pages.admin.packages.create', compact('workHours', 'photoGraphers', 'videoGraphers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
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

        $image = Image::query()->create([
            'image_one' => $name_one,
            'image_two' => $name_two,
            'image_three' => $name_three
        ]);

        Package::query()->create([
            'image_id' => $image->id,
            'photographer_id' => $request->photographer_id,
            'videographer_id' => $request->videographer_id,
            'workhour_id' => $request->workhour_id,
            'name' => $request->name,
            'category' => $request->category,
            'day' => $request->day,
            'flashdisk' => $request->flashdisk,
            'edited' => $request->edited,
            'price' => $request->price
        ]);

        return redirect()->route('admin.package.index')->with('message', 'Package Added!');
    }

    public function edit(Package $package)
    {
        $workHours = Workhour::all();
        $photoGraphers = Photographer::all();
        $videoGraphers = Videographer::all();
        return view('pages.admin.packages.edit', compact('package', 'workHours', 'photoGraphers', 'videoGraphers'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'workhour_id' => 'required',
            'day' => 'required',
            'photographer_id' => 'required',
            'videographer_id' => 'required',
            'flashdisk' => 'required',
            'edited' => 'required',
            'price' => 'required|numeric',
        ]);

        $image = Image::query()->findOrFail($package->image_id);

        if ($request->hasFile('image_one')) {
            $name_one = $request->file('image_one')->getClientOriginalName();
            $request->file('image_one')->storeAs('public/assets/product', $name_one);
        } else {
            $name_one = $image->image_one;
        }

        if ($request->hasFile('image_two')) {
            $name_two = $request->file('image_two')->getClientOriginalName();
            $request->file('image_two')->storeAs('public/assets/product', $name_two);
        } else {
            $name_two = $image->image_two;
        }

        if ($request->hasFile('image_three')) {
            $name_three = $request->file('image_three')->getClientOriginalName();
            $request->file('image_three')->storeAs('public/assets/product', $name_three);
        } else {
            $name_three = $image->image_three;
        }

        Image::query()->findOrFail($package->image_id)->update([
            'image_one' => $name_one,
            'image_two' => $name_two,
            'image_three' => $name_three
        ]);

        $package->update([
            'photographer_id' => $request->photographer_id,
            'videographer_id' => $request->videographer_id,
            'workhour_id' => $request->workhour_id,
            'name' => $request->name,
            'category' => $request->category,
            'day' => $request->day,
            'flashdisk' => $request->flashdisk,
            'edited' => $request->edited,
            'price' => $request->price
        ]);

        return redirect()->route('admin.package.index')->with('message', 'Package Updated!');
    }

    public function destroy(Package $package)
    {
        $image = Image::query()->findOrFail($package->image_id);
        File::delete('storage/assets/product/' . $image->image_one);
        File::delete('storage/assets/product/' . $image->image_two);
        File::delete('storage/assets/product/' . $image->image_three);
        $image->delete();
        $package->delete();

        return redirect()->route('admin.package.index')->with('danger', 'Package Deleted!');
    }
}
