<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    @include('layouts.partials.head')
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    {{-- HEADER --}}
    @include('layouts.partials.header')
    {{-- END HEADER --}}

    <main>
        {{-- YIELD CONTENT --}}
        @yield('content')
        {{-- END YIELD CONTENT --}}
    </main>

    @include('layouts.partials.script')
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
