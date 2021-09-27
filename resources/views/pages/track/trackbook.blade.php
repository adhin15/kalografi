@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-10">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('danger'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <strong>{{ session('danger') }}</strong>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="col-md-5">
                    <div class="row mb-3">
                        <h3 class="fs-1 fw-bold text-secondary">Your Post-Production Progress</h3>
                    </div>

                    @if ($booking->paymentStatus === 'CREATED' || $booking->paymentStatus === 'FULL_PAYMENT_PENDING' || $booking->paymentStatus === 'DOWN_PAYMENT_PAID' || $booking->paymentStatus === 'DOWN_PAYMENT_PENDING' || $booking->paymentStatus === 'INSTALLMENT_PENDING')
                        <div class="alert alert-danger" style="max-width: 28rem;">
                            <strong>Please complete your payment to see your order's progress</strong>
                        </div>
                    @else
                        <div class="row mb-3">
                            <div class="col-md-10">
                                <div class="progress progress-striped active" style="height:8px; margin-top:5px ">
                                    <div class="progress-bar " id="progress_bar" role="progressbar" aria-valuenow="73"
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
                                <p class="mb-0 text-secondary">Current progress:
                                    @if ($status->current_status === 1)
                                        <strong>No Progress</strong>
                                    @elseif($status->current_status === 2)
                                        <strong>All Photos Uploaded</strong>
                                    @elseif($status->current_status === 3)
                                        <strong>Wedding Photobook Delivered</strong>
                                    @elseif($status->current_status === 4)
                                        <strong>Video Uploaded</strong>
                                    @elseif($status->current_status === 5)
                                        <strong>Printing 16R Photos</strong>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <ul class="StepProgress">
                                    <li id="column_status_1" class="StepProgress-item text-secondary">
                                        <strong>All Photos Uploaded</strong>
                                    </li>
                                    <li id="column_status_2" class=" StepProgress-item text-secondary">
                                        <strong>Wedding Photobook Delivered</strong>
                                    </li>
                                    <li id="column_status_3" class=" StepProgress-item text-secondary">
                                        <strong>Video Uploaded</strong>
                                    </li>
                                    <li id="column_status_4" class=" StepProgress-item text-secondary">
                                        <strong>Printing 16R Photos</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>
                @include('pages.track.receipt')
            </div>
        </div>
    </div>

    <script>
        const status = {{ $status->current_status }};

        function ubah() {
            if (status === 1) {
                document.getElementById("column_status_1").classList.toggle(' ');
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
            } else if (status === 2) {
                document.getElementById("percentage").innerHTML = "25%";
            } else if (status === 3) {
                document.getElementById("percentage").innerHTML = "50%";
            } else if (status === 4) {
                document.getElementById("percentage").innerHTML = "75%";
            } else if (status === 5) {
                document.getElementById("percentage").innerHTML = "100%";
            }
        }

        progresspercentage();
        progress();
        ubah();
    </script>

    @include('layouts.partials.footer')
@endsection
