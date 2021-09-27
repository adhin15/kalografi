@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">
        <form action="{{ route('admin.additionals.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Add New Additional Service</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group row justify-content-center mb-3">
                                <div class="col-md-10">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name">Additional Service Name</label>
                                            <input type="text" class="form-control text-secondary @error('name') is-invalid @enderror" name="name" id="name">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="price">Additional Service Price</label>
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
                                            <a class="btn btn-outline-secondary" href="{{ route('admin.additionals.index') }}">
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
