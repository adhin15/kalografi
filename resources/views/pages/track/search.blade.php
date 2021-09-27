@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <div class="row text-center" data-aos="fade-down" data-aos-delay="100" data-aos-duration="500">
            <p class="text-bold text-secondary fs-1">
                Track Your Post-Production Progress
            </p>
        </div>

        <div class="row text-center mb-3" data-aos="fade-down" data-aos-delay="100" data-aos-duration="500">
            <p class=" text-secondary">
                Now you can track the progress of your documentation results
                by only write your order ID!
            </p>
        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
            <div class="col-md-5">
                <form action="{{ route('requestorder') }}" method="GET">
                    <div class="row mb-3">
                        <input type="text" name="order_id" class="form-control form-control-sm text-center"
                            autocomplete="off">
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-kalografi semi-bold btn-block">
                            Check Now!
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
@endsection
