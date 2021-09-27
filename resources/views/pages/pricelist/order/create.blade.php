@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <form action="/pricelist/detail/order" method="post">
            {{ csrf_field() }}
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <h3 class="fs-1 fw-bold text-secondary">Order Details</h3>
                        </div>

                        <div class="row mb-3">
                            <p class="text-secondary">
                                Help us to know what kind of service that you want!
                            </p>
                        </div>

                        <div class="mb-5">
                            <div class="row ps-4 mb-3" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
                                <p class="text-secondary px-0 mb-2 semi-bold">Venue</p>
                                <div class="form-check form-check-inline mb-3 px-0">

                                    <input type="radio" class="btn-check" name="venue" id="outdoor" autocomplete="off"
                                        onchange="changevenuevalue()" checked value="Outdoor">
                                    <label class="btn btn-check-kalografi mb-1" for="outdoor"
                                        style="width: 9rem;">Outdoor</label>

                                    <input type="radio" class="btn-check" name="venue" id="indoor" autocomplete="off"
                                        onchange="changevenuevalue() " value="Indoor">
                                    <label class="btn btn-check-kalografi mb-1" for="indoor"
                                        style="width: 9rem;">Indoor</label>

                                </div>
                            </div>

                            <div class="row ps-4 mb-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                                <p class="text-secondary px-0 mb-2 semi-bold">Tone</p>

                                <div class="form-check form-check-inline px-0">
                                    <input type="radio" class="btn-check" name="tone" id="warm"
                                        onchange="changetonevalue()" checked value="Warm">
                                    <label class="btn btn-check-kalografi mb-1" for="warm" style="width: 9rem;">Warm</label>

                                    <input type="radio" class="btn-check" name="tone" id="moody"
                                        onchange="changetonevalue()" value="Moody">
                                    <label class="btn btn-check-kalografi mb-1" for="moody"
                                        style="width: 9rem;">Moody</label>

                                    <input type="radio" class="btn-check" name="tone" id="light&airy"
                                        onchange="changetonevalue()" value="Light & Airy">
                                    <label class="btn btn-check-kalografi mb-1" for="light&airy" style="width: 9rem;">Light
                                        & Airy</label>
                                </div>

                                <div class="form-check form-check-inline mb-3 px-0">
                                    <input type="radio" class="btn-check" name="tone" id="film_look"
                                        onchange="changetonevalue()" value="Film Look">
                                    <label class="btn btn-check-kalografi mb-1" for="film_look" style="width: 9rem;">Film
                                        Look</label>

                                    <input type="radio" class="btn-check" name="tone" id="cinematic"
                                        onchange="changetonevalue()" value="Cinematic">
                                    <label class="btn btn-check-kalografi mb-1" for="cinematic"
                                        style="width: 9rem;">Cinematic</label>

                                    <input type="radio" class="btn-check" name="tone" id="monochrome"
                                        onchange="changetonevalue()" value="Monochrome">
                                    <label class="btn btn-check-kalografi mb-1" for="monochrome"
                                        style="width: 9rem;">Monochrome</label>
                                </div>
                            </div>

                            <div class="row ps-4" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
                                <p class="text-secondary px-0 mb-2 semi-bold">Wedding Style</p>
                                <div class="form-check form-check-inline mb-3 px-0">
                                    <input type="radio" class="btn-check" name="weddingstyle" id="international"
                                        checked onchange="changeweddingstylevalue()" value="International">
                                    <label class="btn btn-check-kalografi mb-1" for="international"
                                        style="width: 9rem;">International</label>

                                    <input type="radio" class="btn-check" name="weddingstyle" id="traditional"
                                        onchange="changeweddingstylevalue()" value="Traditional">
                                    <label class="btn btn-check-kalografi mb-1" for="traditional"
                                        style="width: 9rem;">Traditional</label>

                                    <input type="radio" class="btn-check" name="weddingstyle" id="islamic"
                                        onchange="changeweddingstylevalue()" value="Islamic">
                                    <label class="btn btn-check-kalografi mb-1" for="islamic"
                                        style="width: 9rem;">Islamic</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h3 class="fs-1 fw-bold text-secondary mb-4">Customer Details</h3>
                            <div class="col ps-4">

                                <div class="form-group mb-3">
                                    <label for="name" class="mb-1 text-secondary small">Full Name</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="mb-1 text-secondary small">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone_number" class="mb-1 text-secondary small">Phone Number</label>
                                    <input type="text" class="form-control" name="phonenumber" id="phone_number" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="customer_address" class="mb-1 text-secondary small">Address</label>
                                    <textarea class="form-control" name="address" id="customer_address" rows="5" required
                                        style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    @include('pages.partials.receipt')
                </div>
            </div>

        </form>
    </div>


    <script>
        var textinput = document.getElementById('fullname');
        textinput.onkeyup = textinput.onkeypress = function() {
            document.getElementById('previewnama').innerHTML = this.value;
        }
    </script>

    <script>
        var textinput = document.getElementById('email');
        textinput.onkeyup = textinput.onkeypress = function() {
            document.getElementById('previewemail').innerHTML = this.value;
        }
    </script>

    <script>
        var textinput = document.getElementById('phone_number');
        textinput.onkeyup = textinput.onkeypress = function() {
            document.getElementById('previewnomor').innerHTML = this.value;
        }
    </script>
    <script>
        var radiosvenue = document.getElementsByName("venue");
        var selectedvenue = Array.from(radiosvenue).find(radio => radio.checked);
        document.getElementById('previewvenue').innerHTML = selectedvenue.value;

        var radiostone = document.getElementsByName("tone");
        var selectedtone = Array.from(radiostone).find(radio => radio.checked);
        document.getElementById('previewtone').innerHTML = selectedtone.value;

        var radiosweddingstyle = document.getElementsByName("weddingstyle");
        var selectedweddingstyle = Array.from(radiosweddingstyle).find(radio => radio.checked);
        document.getElementById('previewweddingstyle').innerHTML = selectedweddingstyle.value;

        function changevenuevalue() {
            var selectedvenue = Array.from(radiosvenue).find(radio => radio.checked);
            document.getElementById('previewvenue').innerHTML = selectedvenue.value;
        }

        function changetonevalue() {
            var selectedtone = Array.from(radiostone).find(radio => radio.checked);
            document.getElementById('previewtone').innerHTML = selectedtone.value;
        }

        function changeweddingstylevalue() {
            var selectedweddingstyle = Array.from(radiosweddingstyle).find(radio => radio.checked);
            document.getElementById('previewweddingstyle').innerHTML = selectedweddingstyle.value;
        }
    </script>
    @include('layouts.partials.footer')
@endsection
