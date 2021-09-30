@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">
        <form action="{{ route('admin.photographer.update', $photographer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Add New Photographer</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group row justify-content-center mb-3">
                                <div class="col-md-10">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name">Photographer Amount</label>
                                            <input type="number" class="form-control text-secondary " name="amount"
                                                id="name" value="{{ $photographer->amount }}">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="price">Photographer Price</label>
                                            <input type="number"
                                                class="form-control text-secondary @error('price') is-invalid @enderror"
                                                name="price" id="price" value="{{ $photographer->price }}">

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
                                                data-bs-target="#deletePhotographerModal">
                                                Delete Photographer
                                            </button>
                                        </div>

                                        <div class="col text-right">
                                            <a class="btn btn-outline-secondary"
                                                href="{{ route('admin.photographer.index') }}">
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
    <div class="modal fade" id="deletePhotographerModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="modal-title text-danger">
                        Are you sure want to delete this photographer?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-sm btn btn-danger"
                        href="{{ route('admin.photographer.destroy', $photographer->id) }}"
                        onclick="event.preventDefault(); document.getElementById('deletePhotographerForm').submit();">
                        Yes, delete this photographer
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal-->

    <form id="deletePhotographerForm" action="{{ route('admin.photographer.destroy', $photographer->id) }}" method="POST"
        class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
