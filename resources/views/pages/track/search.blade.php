@extends('layouts.guest.master')
@section('content')


    <div class="container-fluid py-3 mb-5" style="background-color: #FAFBFA">
        @if (session()->has('message'))
            <div class="row">
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <strong>Order Not Found! Check Your Order ID!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="row text-center" data-aos="fade-down" data-aos-delay="100" data-aos-duration="500">
            <p class="text-bold text-secondary fs-1">
                Track Your Post-Production Progress
            </p>
        </div>

        <div class="row text-center" data-aos="fade-down" data-aos-delay="100" data-aos-duration="500">
            <p class=" text-secondary">
                Now you can track the progress of your documentation results
                by only write your order ID!
            </p>
        </div>

        <div class="row justify-content-center mb-5 px-5" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
            <div class="col-md-5 mb-5">
                <form action="{{ route('requestorder') }}" method="GET">
                    <div class="row mb-3">
                        <input type="text" name="order_id" class="form-control form-control-sm text-center"
                            autocomplete="off">
                    </div>

                    <div class="row mb-5 ">
                        <button type="submit" class="btn btn-kalografi semi-bold btn-block mb-5">
                            Check Now!
                        </button>


                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

@endsection
