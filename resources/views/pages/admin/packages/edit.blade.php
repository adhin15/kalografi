@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">
        <form action="{{ route('admin.package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-md-10">

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>{{ session('message') || session('danger') }}</strong>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @elseif(session()->has('danger'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <strong>{{ session('danger') }}</strong>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Update Package</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group row mb-3">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name">Package Name</label>
                                            <input type="text"
                                                   class="form-control text-secondary @error('name') is-invalid @enderror"
                                                   name="name" id="name" value="{{ $package->name }}">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="category">Category</label>
                                            <select name="category" id="category"
                                                    class="form-control text-secondary small">
                                                <option value="Wedding Package"
                                                    {{ 'Wedding Package' === $package->category ? 'selected' : '' }}>
                                                    Wedding Package
                                                </option>
                                                <option value="Pre-Wedding Package"
                                                    {{ 'Pre-Wedding Package' === $package->category ? 'selected' : '' }}>
                                                    Pre-Wedding Package
                                                </option>
                                                <option value="Engagement Package"
                                                    {{ 'Engagement Package' === $package->category ? 'selected' : '' }}>
                                                    Engagement Package
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="workhour_id">Working Hour</label>
                                            <select name="workhour_id" id="workhour_id"
                                                    class="form-control text-secondary small">
                                                <option value="">-</option>
                                                @foreach ($workHours as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id === $package->workhour->id ? 'selected' : '' }}>
                                                        {{ $item->amount . ' Hours' }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('workhour')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="day">Day</label>
                                            <select name="day" id="day" class="form-control text-secondary small">
                                                <option value="Full Day"
                                                    {{ 'Full Day' === $package->day ? 'selected' : '' }}>
                                                    Full Day
                                                </option>
                                                <option value="Half Day"
                                                    {{ 'Half Day' === $package->day ? 'selected' : '' }}>
                                                    Half Day
                                                </option>
                                                <option value="-" {{ '-' === $package->day ? 'selected' : '' }}>
                                                    -
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="photographer_id">Photographer</label>
                                            <select name="photographer_id" id="photographer_id"
                                                    class="form-control text-secondary small">
                                                @foreach ($photoGraphers as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id === $package->photographer->id ? 'selected' : '' }}>
                                                        {{ $item->amount . ' Photographers' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="videographer_id">Videographer</label>
                                            <select name="videographer_id" id="videographer_id"
                                                    class="form-control text-secondary small">
                                                @foreach ($videoGraphers as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id === $package->videographer->id ? 'selected' : '' }}>
                                                        {{ $item->amount . ' Videographers' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="flashdisk">Flashdisk</label>
                                            <select name="flashdisk" id="flashdisk"
                                                    class="form-control text-secondary small">
                                                <option value="0" {{ 0 === $package->flashdisk ? 'selected' : '' }}>
                                                    No Flashdisk
                                                </option>
                                                <option value="1" {{ 1 === $package->flashdisk ? 'selected' : '' }}>
                                                    1 Flashdisk
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="edited">Edited Photos</label>
                                            <select name="edited" id="edited" class="form-control text-secondary small">
                                                <option value="50" {{ '50' === $package->edited ? 'selected' : '' }}>
                                                    50 Edited Photos
                                                </option>
                                                <option value="100" {{ '100' === $package->edited ? 'selected' : '' }}>
                                                    100 Edited Photos
                                                </option>
                                                <option value="125" {{ '125' === $package->edited ? 'selected' : '' }}>
                                                    125 Edited Photos
                                                </option>
                                                <option value="150" {{ '150' === $package->edited ? 'selected' : '' }}>
                                                    150 Edited Photos
                                                </option>
                                                <option value="200" {{ '200' === $package->edited ? 'selected' : '' }}>
                                                    200 Edited Photos
                                                </option>
                                                <option value="250" {{ '250' === $package->edited ? 'selected' : '' }}>
                                                    250 Edited Photos
                                                </option>
                                                <option value="300" {{ '300' === $package->edited ? 'selected' : '' }}>
                                                    300 Edited Photos
                                                </option>
                                                <option value="500" {{ '500' === $package->edited ? 'selected' : '' }}>
                                                    500 Edited Photos
                                                </option>
                                                <option value="all" {{ 'all' === $package->edited ? 'selected' : '' }}>
                                                    All Edited Photos
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Update Photos</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group row justify-content-evenly mb-3">
                                <div class="col-md-3">
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <img
                                                src="{{ asset('storage/assets/product/' . $package->image->image_one) }}"
                                                class="rounded mb-2" alt="..." style="max-width: 200px; height: auto;">
                                            <label for="image_one" class="form-label">Choose 1st Photo</label>
                                            <input name="image_one" class="form-control form-control" id="image_one"
                                                   type="file" value="{{ $package->image->image_one }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <img
                                                src="{{ asset('storage/assets/product/' . $package->image->image_two) }}"
                                                class="rounded mb-2" alt="..." style="max-width: 200px; height: auto;">
                                            <label for="image_two" class="form-label">Choose 2nd Photo</label>
                                            <input name="image_two" class="form-control form-control" id="image_two"
                                                   type="file" value="{{ $package->image->image_two }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="row mb-3">
                                        <div class="col text-center">
                                            <img
                                                src="{{ asset('storage/assets/product/' . $package->image->image_three) }}"
                                                class="rounded mb-2" alt="..." style="max-width: 200px; height: auto;">
                                            <label for="image_three" class="form-label">Choose 3rd Photo</label>
                                            <input name="image_three" class="form-control form-control" id="image_three"
                                                   type="file" value="{{ $package->image->image_three }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Update Price</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group row justify-content-center mb-3">
                                <div class="col-md-11">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="price">Package Price</label>
                                            <input type="text"
                                                   class="form-control text-secondary @error('price') is-invalid @enderror"
                                                   name="price" id="price" value="{{ $package->price }}">

                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deletePackageModal">
                                                Delete Package
                                            </button>
                                        </div>

                                        <div class="col text-right">
                                            <a class="btn btn-outline-secondary"
                                               href="{{ route('admin.package.index') }}">
                                                Back
                                            </a>

                                            <button class="btn btn-kalografi" type="submit">
                                                Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deletePackageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="modal-title text-danger">
                        Are you sure want to delete this package?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-sm btn btn-danger" href="{{ route('admin.package.destroy', $package->id) }}"
                       onclick="event.preventDefault(); document.getElementById('deletePackageForm').submit();">
                        Yes, delete this package
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal-->

    <form id="deletePackageForm" action="{{ route('admin.package.destroy', $package->id) }}" method="POST"
          class="d-none">
        @csrf
        @method('DELETE')
    </form>

@endsection
