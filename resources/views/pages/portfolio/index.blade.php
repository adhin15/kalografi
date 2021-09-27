@extends('layouts.guest.master')
@section('content')
    {{-- PRODUCTS SECTION --}}
    @include('pages.portfolio.featured')
    @include('pages.portfolio.all
    ')
    @include('pages.portfolio.consultation')
    {{-- END PRODUCTS SECTION --}}

    {{-- FOOTER --}}
    @include('layouts.partials.footer')
    {{-- END FOOTER --}}
@endsection
