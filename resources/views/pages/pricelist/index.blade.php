@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <div class="container">
            <div class="row text-center">
                <h3 class="semi-bold fs-1" style="color: #8F9C69; letter-spacing: -1px;">
                    Once in a lifetime.<br>
                    Capture your precious moment with us.
                </h3>
            </div>
        </div>
    </div>
    {{-- PRODUCTS SECTION --}}
    @include('pages.pricelist.partials.wedding')
    @include('pages.pricelist.partials.pre-wedding')
    @include('pages.pricelist.partials.engagement')

    {{-- END PRODUCTS SECTION --}}

    {{-- FOOTER --}}
    @include('layouts.partials.footer')
    {{-- END FOOTER --}}
@endsection
