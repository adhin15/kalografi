@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">
        <form action="{{ route('admin.videographer.update', $videographer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Add New Videographer</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group row justify-content-center mb-3">
                                <div class="col-md-10">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name">Videographer Amount</label>
                                            <input type="number" class="form-control text-secondary " name="amount"
                                                id="name" value="{{ $videographer->amount }}">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="price">Videographer Price</label>
                                            <input type="number"
                                                class="form-control text-secondary @error('price') is-invalid @enderror"
                                                name="price" id="price" value="{{ $videographer->price }}">

                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteVideographerModal">
                                                Delete Videographer
                                            </button>
                                        </div>

                                        <div class="col text-right">
                                            <a class="btn btn-outline-secondary"
                                                href="{{ route('admin.videographer.index') }}">
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

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteVideographerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="modal-title text-danger">
                        Are you sure want to delete this videographer?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-sm btn btn-danger"
                        href="{{ route('admin.videographer.destroy', $videographer->id) }}"
                        onclick="event.preventDefault(); document.getElementById('deleteVideographerForm').submit();">
                        Yes, delete this videographer
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal-->

    <form id="deleteVideographerForm" action="{{ route('admin.videographer.destroy', $videographer->id) }}"
        method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
