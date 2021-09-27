@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">
        <form action="{{ route('admin.additionals.update', $additional->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                                            <input type="text"
                                                   class="form-control text-secondary @error('name') is-invalid @enderror"
                                                   name="name" id="name" value="{{ $additional->name }}">

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
                                            <input type="text"
                                                   class="form-control text-secondary @error('price') is-invalid @enderror"
                                                   name="price" id="price" value="{{ $additional->price }}">

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
                                                    data-bs-target="#deleteAdditionalModal">
                                                Delete Additional Service
                                            </button>
                                        </div>

                                        <div class="col text-right">
                                            <a class="btn btn-outline-secondary"
                                               href="{{ route('admin.additionals.index') }}">
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
    <div class="modal fade" id="deleteAdditionalModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="modal-title text-danger">
                        Are you sure want to delete this additional service?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-sm btn btn-danger"
                       href="{{ route('admin.additionals.destroy', $additional->id) }}"
                       onclick="event.preventDefault(); document.getElementById('deleteAdditionalForm').submit();">
                        Yes, delete this additional service
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal-->

    <form id="deleteAdditionalForm" action="{{ route('admin.additionals.destroy', $additional->id) }}"
          method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
