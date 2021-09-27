@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <img src="{{ asset('placeholders/Group 106.png') }}" alt="peeps" class="d-flex mx-auto">
                    </div>

                    @if($booking->paymentStatus === 'CREATED' || $booking->paymentStatus === 'FULL_PAYMENT_PENDING' || $booking->paymentStatus === 'DOWN_PAYMENT_PENDING' || $booking->paymentStatus === 'DOWN_PAYMENT_PAID' || $booking->paymentStatus === 'INSTALLMENT_PENDING')
                        <div class="row mb-3">
                            <div class="col">
                                <p class="text-bold text-secondary fs-1">
                                    Waiting for your payment confirmation...
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="row mb-3">
                            <p class="text-bold text-secondary fs-1 mb-0">Payment complete!</p>
                            <p class="semi-bold text-secondary fs-2">Thank you for using our service!</p>
                        </div>

                        <div class="row">
                            <a class="btn btn-lg btn-kalografi semi-bold btn-block" href="{{ route('landing') }}">
                                Back to Home
                            </a>
                        </div>
                    @endif
                </div>
                @include('pages.track.receipt')
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
@endsection
