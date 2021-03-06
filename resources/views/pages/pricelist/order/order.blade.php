@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <div class="container">

            <div class="row justify-content-evenly">
                <div class="col-md-6">
                    <div id="mahesaCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel" data-aos="fade-in"
                        data-aos-delay="300" data-aos-duration="800">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#mahesaCarousel" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#mahesaCarousel" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#mahesaCarousel" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner" style="border-radius: 20px">
                            <div class="carousel-item active">
                                <img src="{{ $image->image_one_secure_url }}"
                                    class="d-block w-100 order-image-skeleton-loader" alt="..."
                                    style="min-width: 100%; height: 500px;"">
                                        </div>
                                            <div class="    carousel-item">
                                <img src="{{ $image->image_two_secure_url }}"
                                    class="d-block w-100 order-image-skeleton-loader" alt="..."
                                    style="min-width: 100%; height: 500px;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ $image->image_three_secure_url }}"
                                    class="d-block w-100 order-image-skeleton-loader" alt="..."
                                    style="min-width: 100%; height: 500px;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#mahesaCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mahesaCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="col-md-5">
                    <form action="{{ route('pricelist.post-order') }}" method="post" id="total_form">
                        @csrf
                        <div class="card border-0 shadow-sm p-4" style="border-radius: 10px" data-aos="fade-left"
                            data-aos-delay="300" data-aos-duration="800">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <h3 class="fw-bold fs-2 text-secondary">
                                        {{ $package->name }} <br>
                                        {{ $package->category }}
                                    </h3>
                                </div>

                                <div class="row mb-3">
                                    <h3 class="fw-bold fs-3 text-kalografi">
                                        IDR {{ number_format($package->price) }}
                                    </h3>
                                </div>

                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <label for="book_date" class="mb-1 text-secondary small text-bold">Book Date</label>
                                        <input type="date" id="date" class="form-control text-secondary small "
                                            name="book_date" required style="">

                                        <small class="" style="font-size:12px;color:grey">Book Date Must Be 2
                                            Weeks
                                            Earlier From Photoshoot
                                            Session
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-9">
                                        <label for="printed_photo" class="mb-1 text-secondary small text-bold">Printed
                                            Photo</label>
                                        <select class="form-control text-secondary small" name="printedphoto_id"
                                            id="printedphoto_id">

                                            @foreach ($printedphoto as $item)
                                                <option value="{{ $item->id }} "
                                                    data-bs-harga-pp="{{ $item->price }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 text-center form-group">
                                        <label for="print_quantity"
                                            class="mb-1 text-secondary small text-bold">Quantity</label>
                                        <input type="number" class="form-control" name="printedphoto_qty" min="1"
                                            id="print_quantity" value="1" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-5">
                                    <div class="col-md-9">
                                        <label for="photobook" class="mb-1 text-secondary small text-bold">Photobook</label>
                                        <select class="form-control text-secondary small" name="photobook_id"
                                            id="photobook_id">
                                            @foreach ($photobook as $item)
                                                <option value="{{ $item->id }}"
                                                    data-bs-harga-pb="{{ $item->price }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-3 text-center">
                                        <label for="photobook_quantity"
                                            class="mb-1 text-secondary small text-bold">Quantity</label>
                                        <input type="number" class="form-control" name="photobook_qty" min="1"
                                            id="photobook_quantity" value="1" required>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col">
                                        <p class="mb-1 text-secondary text-bold">Additional Service</p>
                                    </div>
                                </div>
                                <div class="form-group text-secondary row mb-5">
                                    @foreach ($additionals as $additional)
                                        <div class="col-md-6">
                                            <label class="container-checkbox">{{ $additional->name }}
                                                <input type="checkbox" id="additionals" name="additionals[]"
                                                    value="{{ $additional->id }}"
                                                    data-price="{{ $additional->price }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach

                                </div>

                                <div class="form-group  row">
                                    <div class="col">
                                        <button type="button" class="btn text-white" onclick="validate()"
                                            style="display: block; width: 100%; background-color: #8F9C69">Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row  mt-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container px-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3" data-aos="fade-up" data-aos-delay="0" data-aos-duration="800">
                        <h3 class="fw-bold fs-2 text-secondary">Terms and Conditions</h3>
                    </div>
                    <div class="row mb-3" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                        <strong class="text-secondary fs-5">Reschedule Policy</strong>
                        <p class="text-secondary pe-3">
                            Free Reschedule is applicable if you submit the reschedule request
                            by at maximum 96 hours (4 days) before your initial photoshoot date.
                        </p>
                    </div>
                    <div class="row mb-3" data-aos="fade-up" data-aos-delay="150" data-aos-duration="800">
                        <strong class="text-secondary fs-5">Cancellation Policy</strong>
                        <p class="text-secondary pe-3">
                            Free Cancellation is applicable if you submit the cancellation request
                            by at maximum 96 hours (4 days) before your initial photoshoot date.
                        </p>
                    </div>
                    <div class="row mb-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                        <strong class="text-secondary fs-5">48 Hours Photo Delivery</strong>
                        <p class="text-secondary pe-3">
                            You can get all photo files via Google Drive in 48 Hours, then choose
                            the photo you want to get edited.
                        </p>
                    </div>
                </div>

                <div class="col-md-5 offset-md-1">
                    <div class="row mb-3" data-aos="fade-up" data-aos-delay="0" data-aos-duration="800">
                        <h3 class="fw-bold fs-2 text-secondary">What's Included</h3>
                    </div>
                    <div class="row px-5 mb-3" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                        <ul class="text-secondary">
                            @if ($package->category == 'Wedding')
                                <li>{{ $package->workhour->amount }} Work Hours</li>
                            @else
                                <li>{{ $package->workhour->amount }} Spot</li>
                            @endif

                            @if ($package->photographer && $package->videographer)
                                <li>
                                    {{ $package->photographer->amount }} Photographers
                                    + {{ $package->videographer->amount }} Videographers
                                </li>
                            @elseif($package->photographer)
                                <li>
                                    {{ $package->photographer->amount }} Photographers
                                </li>
                            @elseif($package->videographer)
                                <li>
                                    {{ $package->photographer->amount }} Videographers
                                </li>
                            @endif
                            @if ($package->flashdisk == 0)
                                <li>All Files by Google Drive</li>
                            @else
                                <li>Flashdisk Include All Files</li>
                            @endif
                            <li>{{ $package->edited }} Edited Photos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // declaring variable
        let numWeeks = 2;
        let now = new Date();
        let total_price;
        let totalPriceInRupiah;
        let additionalPrice = 0;

        now.setDate(now.getDate() + numWeeks * 7);
        var today = now.toISOString().split('T')[0];
        document.getElementsByName("book_date")[0].setAttribute('min', today);

        function numberToRupiah(number) {
            const format = number.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            return convert.join(',').split('').reverse().join('');
        }

        //
        const cbs = document.querySelectorAll('input[type=checkbox]');
        for (let i = 0; i < cbs.length; i++) {
            cbs[i].addEventListener('change', function() {
                if (this.checked) {
                    additionalPrice += parseInt(this.getAttribute('data-price'))
                } else {
                    additionalPrice -= parseInt(this.getAttribute('data-price'))
                }
            });
        }



        function validate() {
            var date = document.getElementById("date").value;
            if (date != "") {


                const printedPhotoSelectedId = document.forms['total_form'].elements['printedphoto_id'].options[document
                    .forms[
                        'total_form'].elements['printedphoto_id'].selectedIndex].getAttribute('data-bs-harga-pp');
                const printedPhotoQty = document.getElementById("print_quantity").value;
                const photoBookSelectedId = document.forms['total_form'].elements['photobook_id'].options[document.forms[
                    'total_form'].elements['photobook_id'].selectedIndex].getAttribute('data-bs-harga-pb');
                const photoBookQty = document.getElementById("photobook_quantity").value;

                const packagePrice = parseInt({{ $package->price }});
                const printedPhotoPrice = parseInt(printedPhotoSelectedId);
                const photoBookPrice = parseInt(photoBookSelectedId);

                const printedPhotoTotal = printedPhotoPrice * printedPhotoQty;
                const photoBookTotal = photoBookPrice * photoBookQty;
                total_price = packagePrice + printedPhotoTotal + photoBookTotal + additionalPrice;
                totalPriceInRupiah = numberToRupiah(total_price);


                Swal.fire({
                    icon: 'success',
                    title: 'Your Bill Is',
                    text: "Rp. " + totalPriceInRupiah,
                    showCancelButton: true,
                    confirmButtonColor: "#8F9C69"

                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('total_form').submit();
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You need to fill the bookdate',
                    confirmButtonColor: "#8F9C69",
                })
            }
        }
    </script>
    @include('layouts.partials.footer')

@endsection
