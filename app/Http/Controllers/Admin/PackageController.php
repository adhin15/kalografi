<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Package;
use App\Models\Photographer;
use App\Models\Videographer;
use App\Models\Workhour;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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

        //GET REQUESTED FILE
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');
        //PROCESS FILE NAME
        $name_one = $this->processFileName($request)['name_one'];
        $name_two = $this->processFileName($request)['name_two'];
        $name_three = $this->processFileName($request)['name_three'];
        $package_name = $this->processFileName($request)['package_name'];

        //UPLOAD IMAGE TO CLOUDINARY
        $cloudinaryImageOne = $image_one->storeOnCloudinaryAs('kalografi/packages/' . $package_name . '/', $name_one);
        $imageOneSecureUrl = $cloudinaryImageOne->getSecurePath();
        $imageOnePublicId = $cloudinaryImageOne->getPublicId();
        $cloudinaryImageTwo = $image_two->storeOnCloudinaryAs('kalografi/packages/' . $package_name . '/', $name_two);
        $imageTwoSecureUrl = $cloudinaryImageTwo->getSecurePath();
        $imageTwoPublicId = $cloudinaryImageTwo->getPublicId();
        $cloudinaryImageThree = $image_three->storeOnCloudinaryAs('kalografi/packages/' . $package_name . '/', $name_three);
        $imageThreeSecureUrl = $cloudinaryImageThree->getSecurePath();
        $imageThreePublicId = $cloudinaryImageThree->getPublicId();

        $image = Image::query()->create([
            'image_one_secure_url' => $imageOneSecureUrl,
            'image_one_public_id' => $imageOnePublicId,
            'image_two_secure_url' => $imageTwoSecureUrl,
            'image_two_public_id' => $imageTwoPublicId,
            'image_three_secure_url' => $imageThreeSecureUrl,
            'image_three_public_id' => $imageThreePublicId,
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
            //GET FILE
            $image_one = $request->file('image_one');
            //PROCESS FILE NAME
            $name_one = $this->processFileName($request)['name_one'];
            $package_name = $this->processFileName($request)['package_name'];
            //DELETE PHOTO USING ITS PUBLIC ID FROM CLOUDINARY
            Cloudinary::destroy($image->image_one_public_id);
            //UPLOAD TO CLOUDINARY
            $cloudinaryImageOne = $image_one->storeOnCloudinaryAs('kalografi/packages/' . $package_name . '/', $name_one);
            $imageOneSecureUrl = $cloudinaryImageOne->getSecurePath();
            $imageOnePublicId = $cloudinaryImageOne->getPublicId();

        } else {
            $imageOneSecureUrl = $image->image_one_secure_url;
            $imageOnePublicId = $image->image_one_public_id;
        }

        if ($request->hasFile('image_two')) {
            //GET FILE
            $image_two = $request->file('image_two');
            //PROCESS FILE NAME
            $name_two = $this->processFileName($request)['name_two'];
            $package_name = $this->processFileName($request)['package_name'];
            //DELETE PHOTO USING ITS PUBLIC ID FROM CLOUDINARY
            Cloudinary::destroy($image->image_two_public_id);
            //UPLOAD TO CLOUDINARY
            $cloudinaryImageTwo = $image_two->storeOnCloudinaryAs('kalografi/packages/' . $package_name . '/', $name_two);
            $imageTwoSecureUrl = $cloudinaryImageTwo->getSecurePath();
            $imageTwoPublicId = $cloudinaryImageTwo->getPublicId();

        } else {
            $imageTwoSecureUrl = $image->image_two_secure_url;
            $imageTwoPublicId = $image->image_two_public_id;
        }

        if ($request->hasFile('image_three')) {
            //GET FILE
            $image_three = $request->file('image_three');
            //PROCESS FILE NAME
            $name_three = $this->processFileName($request)['name_three'];
            $package_name = $this->processFileName($request)['package_name'];
            //DELETE PHOTO USING ITS PUBLIC ID FROM CLOUDINARY
            Cloudinary::destroy($image->image_three_public_id);
            //UPLOAD TO CLOUDINARY
            $cloudinaryImageThree = $image_three->storeOnCloudinaryAs('kalografi/packages/' . $package_name . '/', $name_three);
            $imageThreeSecureUrl = $cloudinaryImageThree->getSecurePath();
            $imageThreePublicId = $cloudinaryImageThree->getPublicId();

        } else {
            $imageThreeSecureUrl = $image->image_three_secure_url;
            $imageThreePublicId = $image->image_three_public_id;
        }

        $image->update([
            'image_one_secure_url' => $imageOneSecureUrl,
            'image_one_public_id' => $imageOnePublicId,
            'image_two_secure_url' => $imageTwoSecureUrl,
            'image_two_public_id' => $imageTwoPublicId,
            'image_three_secure_url' => $imageThreeSecureUrl,
            'image_three_public_id' => $imageThreePublicId,
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
        //DELETE IMAGE USING ITS PUBLIC ID FROM CLOUDINARY
        Cloudinary::destroy($image->image_one_public_id);
        Cloudinary::destroy($image->image_two_public_id);
        Cloudinary::destroy($image->image_three_public_id);
        $image->delete();
        $package->delete();

        return redirect()->route('admin.package.index')->with('danger', 'Package Deleted!');
    }

    public function processFileName(Request $request): array
    {
        //SET FILENAME
        $package_name = $request->name;
        $lowerCaseString = strtolower($package_name);
        $titleCaseString = ucwords($lowerCaseString);
        $stripFromSpace = str_replace(' ', '', $titleCaseString);
        $camelCaseString = lcfirst($stripFromSpace);

        $name_one = $camelCaseString . '1_' . bin2hex(random_bytes(3));
        $name_two = $camelCaseString . '2_' . bin2hex(random_bytes(3));
        $name_three = $camelCaseString . '3_' . bin2hex(random_bytes(3));

        return [
            'name_one' => $name_one,
            'name_two' => $name_two,
            'name_three' => $name_three,
            'package_name' => $package_name
        ];
    }
}
