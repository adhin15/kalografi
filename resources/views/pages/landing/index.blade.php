@extends('layouts.guest.master')
@section('content')
    {{-- CAROUSEL --}}
    @include('pages.landing.carousel')
    {{-- END CAROUSEL --}}

    {{-- PRODUCTS SECTION --}}
    @include('pages.landing.products')
    {{-- END PRODUCTS SECTION --}}

    {{-- THIRD SECTION --}}
    @include('pages.landing.promote')
    {{-- END THIRD SECTION --}}

    {{-- FOURTH SECTION --}}
    @include('pages.landing.best-of-nine')
    {{-- END FOURTH SECTION --}}

    {{-- FIFTH SECTION --}}
    @include('pages.landing.offering')
    {{-- END FIFTH SECTION --}}

    {{-- SIXTH SECTION --}}
    @include('pages.landing.feedback')
    {{-- END SIXTH SECTION --}}

    {{-- FOOTER --}}
    @include('layouts.partials.footer')
    {{-- END FOOTER --}}
@endsection
