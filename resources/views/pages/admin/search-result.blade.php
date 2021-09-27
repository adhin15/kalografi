@extends('pages.admin.layouts.master')
@section('content')
    <div class="container-fluid py-3" style="background-color: #FAFBFA">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-5">

                @if($booking->paymentStatus === 'CREATED' || $booking->paymentStatus === 'DOWN_PAYMENT_PAID')
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <strong>Payment Not Complete</strong>
                    </div>
                @endif

                <div class="row mb-3">
                    <h3 class="fs-1 fw-bold text-secondary">Post-Production Progress</h3>
                </div>

                <div class="row mb-3">
                    <div class="col-md-10">
                        <div class="progress progress-striped active" style="height:8px; margin-top:5px ">
                            <div class="progress-bar" id="progress_bar" role="progressbar" aria-valuenow="73"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style=" width: 75% ; background-color: #8F9C69">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <p id="percentage" class="progress-label"></p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <p class="mb-0">
                            Current progress: <strong id="progressCount"></strong>
                        </p>
                        <small>
                            Last Updated: <strong>{{ $status->updated_at->diffForHumans() }}</strong>
                            {{--<strong>{{ \Carbon\Carbon::parse($status->updated_at)->toDayDateTimeString() }}</strong>--}}
                        </small>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <ul class="StepProgress">
                            <li id="column_status_1" class="StepProgress-item">
                                <strong>All Photos Uploaded</strong>
                            </li>
                            <li id="column_status_2" class=" StepProgress-item ">
                                <strong>Wedding Photobook Delivered</strong>
                            </li>
                            <li id="column_status_3" class=" StepProgress-item ">
                                <strong>Video Uploaded</strong>
                            </li>
                            <li id="column_status_4" class=" StepProgress-item">
                                <strong>Printing 16R Photos</strong>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <form action="{{ route('admin.update-status') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <input type="hidden" class="form-control form-control-sm text-center"
                                       name="bookingid" value="{{ $booking->id }}">
                                <input type="hidden" name="status_value" value="{{ $status->current_status }} + 1">
                                <select class="form-control text-secondary small" name="status_value" id="">
                                    <option value="1" {{ 1 === $status->current_status ? 'selected' : '' }}>No
                                        Progress
                                    </option>
                                    <option value="2" {{ 2 === $status->current_status ? 'selected' : '' }}>All
                                        Photos Uploaded
                                    </option>
                                    <option value="3" {{ 3 === $status->current_status ? 'selected' : '' }}>Wedding
                                        Photobook Delivered
                                    </option>
                                    <option value="4" {{ 4 === $status->current_status ? 'selected' : '' }}>Video
                                        Uploaded
                                    </option>
                                    <option value="5" {{ 5 === $status->current_status ? 'selected' : '' }}>Printing
                                        16R Photos
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-kalografi semi-bold">Update Status</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('pages.admin.receipt')
        </div>
    </div>

    <script>
        const status = {{ $status->current_status }};

        function ubah() {
            if (status === 1) {
                document.getElementById("column_status_1").classList.toggle('');
            } else if (status === 2) {
                document.getElementById("column_status_1").classList.toggle('is-done');
                document.getElementById("column_status_2").classList.toggle('');
            } else if (status === 3) {
                document.getElementById("column_status_1").classList.toggle('is-done');
                document.getElementById("column_status_2").classList.toggle('is-done');
                document.getElementById("column_status_3").classList.toggle('');
            } else if (status === 4) {
                document.getElementById("column_status_1").classList.toggle('is-done');
                document.getElementById("column_status_2").classList.toggle('is-done');
                document.getElementById("column_status_3").classList.toggle('is-done');
                document.getElementById("column_status_4").classList.toggle('');
            } else if (status === 5) {
                document.getElementById("column_status_1").classList.toggle('is-done');
                document.getElementById("column_status_2").classList.toggle('is-done');
                document.getElementById("column_status_3").classList.toggle('is-done');
                document.getElementById("column_status_4").classList.toggle('is-done');
            }
        }

        function progress() {
            if (status === 1) {
                document.getElementById("progress_bar").style.width = "0%";
            } else if (status === 2) {
                document.getElementById("progress_bar").style.width = "25%";
            } else if (status === 3) {
                document.getElementById("progress_bar").style.width = "50%";
            } else if (status === 4) {
                document.getElementById("progress_bar").style.width = "75%";
            } else if (status === 5) {
                document.getElementById("progress_bar").style.width = "100%";
            }
        }

        function progresspercentage() {
            if (status === 1) {
                document.getElementById("percentage").innerHTML = "0%";
                document.getElementById('progressCount').innerHTML = "0%";
            } else if (status === 2) {
                document.getElementById("percentage").innerHTML = "25%";
                document.getElementById('progressCount').innerHTML = "25%";
            } else if (status === 3) {
                document.getElementById("percentage").innerHTML = "50%";
                document.getElementById('progressCount').innerHTML = "50%";
            } else if (status === 4) {
                document.getElementById("percentage").innerHTML = "75%";
                document.getElementById('progressCount').innerHTML = "75%";
            } else if (status === 5) {
                document.getElementById("percentage").innerHTML = "100%";
                document.getElementById('progressCount').innerHTML = "100%";
            }
        }

        progresspercentage();
        progress();
        ubah();
    </script>
@endsection
