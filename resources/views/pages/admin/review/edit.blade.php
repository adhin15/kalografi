@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3">
        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-kalografi">Add New Discount</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="form-group row justify-content-center mb-3">
                                <div class="col-md-10">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                class="form-control text-secondary @error('name') is-invalid @enderror"
                                                name="name" id="name" value="{{ $review->name }}" disabled>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="amount">Review</label>
                                            <input type="text" class="form-control text-secondary" name="comment"
                                                id="amount" value="{{ $review->comment }}" disabled>

                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="amount">Status</label>

                                            <select name="status" class="form-select" id="">
                                                <option value="1">Don't Show</option>
                                                <option value="2">Show on Landing</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteReviewModal">
                                                Delete Review
                                            </button>
                                        </div>

                                        <div class="col text-right">
                                            <a class="btn btn-outline-secondary"
                                                href="{{ route('admin.reviews.index') }}">
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
    <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="modal-title text-danger">
                        Are you sure want to delete this discount?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-sm btn btn-danger" href="{{ route('admin.reviews.destroy', $review->id) }}"
                        onclick="event.preventDefault(); document.getElementById('deleteReviewForm').submit();">
                        Yes, delete this discount
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal-->

    <form id="deleteReviewForm" action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
        class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
