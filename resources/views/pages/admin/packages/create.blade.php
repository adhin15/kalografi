@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">
        <form action="{{ route('admin.paket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Add New Package</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group row mb-3">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="namapaket">Package Name</label>
                                            <input type="text" class="form-control text-secondary @error('namapaket') is-invalid @enderror" name="namapaket" id="namapaket">

                                            @error('namapaket')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="kategori">Category</label>
                                            <select name="kategori" id="kategori" class="form-control text-secondary small">
                                                <option value="Wedding Package">Wedding Package</option>
                                                <option value="Pre-Wedding Package">Pre-Wedding Package</option>
                                                <option value="Engagement Package">Engagement Package</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="workhours">Working Hour</label>
                                            <input type="text" class="form-control text-secondary @error('workhours') is-invalid @enderror" name="workhours" id="workhours">

                                            @error('workhours')
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
                                                <option value="Full Day">Full Day</option>
                                                <option value="Half Day">Half Day</option>
                                                <option value="-">-</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="photographers">Photographer</label>
                                            <select name="photographers" id="photographers" class="form-control text-secondary small">
                                                <option value="1">1 Photographer</option>
                                                <option value="2">2 Photographer</option>
                                                <option value="3">3 Photographer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="videographers">Videographer</label>
                                            <select name="videographers" id="videographers" class="form-control text-secondary small">
                                                <option value="1">1 Videographer</option>
                                                <option value="2">2 Videographer</option>
                                                <option value="3">3 Videographer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="flashdisk">Flashdisk</label>
                                            <select name="flashdisk" id="flashdisk" class="form-control text-secondary small">
                                                <option value="0">No Flashdisk</option>
                                                <option value="1">1 Flashdisk</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-11">
                                            <label for="edited">Edited Photos</label>
                                            <select name="edited" id="edited" class="form-control text-secondary small">
                                                <option value="50">50 Edited Photos</option>
                                                <option value="100">100 Edited Photos</option>
                                                <option value="125">125 Edited Photos</option>
                                                <option value="150">150 Edited Photos</option>
                                                <option value="200">200 Edited Photos</option>
                                                <option value="250">250 Edited Photos</option>
                                                <option value="300">300 Edited Photos</option>
                                                <option value="500">500 Edited Photos</option>
                                                <option value="all">All Edited Photos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Add Photos</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group row justify-content-evenly mb-3">
                                <div class="col-md-3">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="image_one" class="form-label">Choose 1st Photo</label>
                                            <input name="image_one" class="form-control form-control @error('image_one') is-invalid @enderror" id="image_one" type="file">

                                            @error('image_one')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="image_two" class="form-label">Choose 2nd Photo</label>
                                            <input name="image_two" class="form-control form-control @error('image_two') is-invalid @enderror" id="image_two" type="file">

                                            @error('image_two')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="image_three" class="form-label">Choose 3rd Photo</label>
                                            <input name="image_three" class="form-control form-control @error('image_three') is-invalid @enderror" id="image_three" type="file">

                                            @error('image_three')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Input Price</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group row justify-content-center mb-3">
                                <div class="col-md-11">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="price">Package Price</label>
                                            <input type="text" class="form-control text-secondary @error('price') is-invalid @enderror" name="price" id="price">

                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col text-right">
                                            <a class="btn btn-outline-secondary" href="{{ route('admin.paket.index') }}">
                                                Back
                                            </a>

                                            <button class="btn btn-kalografi" type="submit">
                                                Submit
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
@endsection
