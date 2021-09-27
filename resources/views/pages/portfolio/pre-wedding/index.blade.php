@extends('layouts.guest.master')
@section('content')

    <div class="container-fluid py-5" style="background-color: #FAFBFA">

        <div class="container">
            <div class="row justify-content-evenly">
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100" data-aos-duration="500">
                    <div id="mahawiraCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#mahawiraCarousel" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#mahawiraCarousel" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#mahawiraCarousel" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner" style="border-radius: 20px">
                            <div class="carousel-item active">
                                <img src="{{ asset('placeholders/mahawira-carousel-1.jpg') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('placeholders/mahawira-carousel-1.jpg') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('placeholders/mahawira-carousel-1.jpg') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#mahawiraCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mahawiraCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>


                <div class="col-md-5" data-aos="fade-left" data-aos-delay="0" data-aos-duration="500">
                    <div class="row mb-2">
                        <p class="fs-7">17 June 2021</p>
                        <h4 class="fw-bold fs-4 text-secondary">
                            Prewedding R & B :
                        </h4>
                        <h1 class="fw-bold font-primary text-secondary">
                            Light and Airy <br>
                            Sunset in Jepara
                        </h1>
                    </div>

                    <div class="row mb-4" style="width: 60%">
                        <div class="col">
                            <div class="tags box-tag" style="margin-right:-10px">Outdoor</div>
                        </div>
                        <div class="col ">
                            <div href="#" class="tags box-tag">Elegant</div>
                        </div>
                        <div class="col ">
                            <div href="#" class="tags box-tag">Warm</div>
                        </div>
                    </div>

                    <div class="row mb-2" style="width: 79%">
                        <p class="fs-7">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="" class="btn text-white fs-7"
                                style="display: block; height:130%; width: 45%; background-color: #8F9C69">Book for
                                Prewedding Session
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-5">
            <div class="container" data-aos="fade-in" data-aos-delay="125">
                <div class="row mb-5">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
                            <div class="card border-0">
                                <img src="{{ asset('placeholders/1.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col" data-aos="fade-up" data-aos-delay="150" data-aos-duration="500">
                            <div class="card border-0">
                                <img src="{{ asset('placeholders/2.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
                            <div class="card border-0">
                                <img src="{{ asset('placeholders/3.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col" data-aos="fade-up" data-aos-delay="250" data-aos-duration="500">
                            <div class="card border-0">
                                <img src="{{ asset('placeholders/4.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col">
                            <div class="card border-0" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
                                <img src="{{ asset('placeholders/5.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col">
                            <div class="card border-0" data-aos="fade-up" data-aos-delay="350" data-aos-duration="500">
                                <img src="{{ asset('placeholders/6.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col" data-aos="fade-up" data-aos-delay="400" data-aos-duration="500">
                            <div class="card border-0">
                                <img src="{{ asset('placeholders/7.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col" data-aos="fade-up" data-aos-delay="450" data-aos-duration="500">
                            <div class="card border-0">
                                <img src="{{ asset('placeholders/8.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>

                        <div class="col" data-aos="fade-up" data-aos-delay="500" data-aos-duration="500">
                            <div class="card border-0">
                                <img src="{{ asset('placeholders/9.jpg') }}" class="card-img-top" alt="..."
                                    style="border-radius: 10px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.partials.footer')
@endsection
