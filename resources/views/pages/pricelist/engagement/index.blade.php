@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <div class="container">
            <div class="row text-center mb-5">
                <h3 class="semi-bold fs-1 mb-0" style="color: #8F9C69; letter-spacing: -1px;">
                    Engagement Documentation Package
                </h3>
            </div>

            <div class="row row-cols-1 row-cols-md-3 justify-content-center">
                @foreach ($package as $item)
                    @if ($item->category == 'Engagement Package')
                        <form action="{{ route('pricelist.select-package') }}" method="POST">
                            @csrf

                            <div class="col-mb-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                                data-aos-duration="800">
                                <div class="card border-0 shadow-sm" style="border-radius: 20px;" data-aos="fade-up"
                                    data-aos-delay="{{ $loop->index * 100 }} " data-aos-duration="800">
                                    <img src="{{ $item->image->image_one_secure_url }}"
                                        class="card-img-top image-skeleton-loader" alt="..."
                                        style="border-radius: 15px; width: 100%; height: 15vw; object-fit: cover;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="card-title text-center my-2">
                                                <input type="hidden" name="package_id" value="{{ $item->id }}">
                                                <h4 class="semi-bold text-secondary" style="letter-spacing: -0.5px">
                                                    {{ $item->name }} <br>
                                                    {{ $item->category }}
                                                </h4>
                                            </div>
                                        </div>


                                        <div class="row text-center mb-3">
                                            <h5 class="text-bold text-kalografi">IDR {{ number_format($item->price) }}
                                            </h5>
                                        </div>

                                        <div class="row text-center mb-4">
                                            <small class="mb-2">{{ $item->workhour->amount }} Spot</small>
                                            <small class="mb-2">{{ $item->photographer->amount }} Photographer
                                                @if ($item->videographer !== null)
                                                    + {{ $item->videographer->amount }} Videographer
                                                @endif
                                            </small>
                                            @if ($item->flashdisk == 0)
                                                <small class="mb-2">All Files by Google Drive</small>
                                            @else
                                                <small class="mb-2">Flashdisk Include All Files</small>
                                            @endif
                                            <small>{{ $item->edited }} Edited Photos</small>
                                        </div>

                                        <div class="row justify-content-center mb-3">
                                            <div class="col-md-6 text-kalografi text-center ">
                                                <button type="submit" class="btn btn-kalografi btn-sm text-bold"
                                                    style="width: 100%; height:150%">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>


            @include('pages.partials.custom')


        </div>
    </div>

    <script>
        for (let i = 0; i < cbs.length; i++) {
            cbs[i].addEventListener('change', function() {
                if (this.checked) {
                    additionalPrice += parseInt(this.getAttribute('data-price'))
                } else {
                    additionalPrice -= parseInt(this.getAttribute('data-price'))
                }
            });
        }
    </script>

@include(' layouts.partials.footer') @endsection
