@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <div class="row mb-4 text-center mt-3" data-aos="fade-down" data-aos-delay="100" data-aos-duration="500">
            <div class="col">
                <h3 class="semi-bold mb-0" style="color: #8F9C69; letter-spacing: -1px; font-size:48px">
                    Customize your own package
                </h3>
            </div>
        </div>

        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="500">
            <div class="col-sm-8">
                <div class="card shadow-sm border-0 pe-3 py-2" style="border-radius: 10px">
                    <div class="card-body">
                        <form action="{{ route('post-custom') }}" method="post" id="total_form">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-5" style="margin: 35px">

                                    <input type="hidden" id="idpaket" name="paket_id" value="0">
                                    <input type="hidden" id="grand_total" name="totalprice" value="0">

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label class="mb-1 text-secondary" for="bookdate">Book Date</label>
                                            <input type="date" class="form-control text-secondary " name="bookdate"
                                                id="bookdate" style="height: 70%" required>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label class="mb-1 text-secondary" for="photographer_id">Photographer</label>
                                            <select class="form-control text-secondary small" name="photographer_id"
                                                id="photographer_id" style="height: 70%">
                                                @foreach($photographers as $item)
                                                    <option value="{{ $item->id }}" data-bs-harga-photo="{{ $item->price }}">
                                                        {{ $item->amount . ' Photographers' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label class="mb-1 text-secondary" for="videographer_id">Videographer</label>
                                            <select class="form-control text-secondary small" name="videographer_id"
                                                id="videographer_id" style="height: 70%">
                                                @foreach($videographers as $item)
                                                    <option value="{{ $item->id }}" data-bs-harga-video="{{ $item->price }}">
                                                        {{ $item->amount . ' Videographers' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label class="mb-1 text-secondary" for="workhour_id">Work Hours</label>
                                            <select class="form-control text-secondary small" name="workhour_id"
                                                id="workhour_id" style="height: 70%">
                                                @foreach($workhours as $item)
                                                    <option value="{{ $item->id }}" data-bs-workhoursprice="{{ $item->price }}">
                                                        {{ $item->amount . ' Hours' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5" style="margin: 40px">
                                    <div class="row mb-4">
                                        <div class="col">
                                            <label class="mb-1 text-secondary" for="printedphoto_id">Printed Photo</label>
                                            <select class="form-control text-secondary small" name="printedphoto_id"
                                                    id="printedphoto_id" style="height: 70%">
                                                @foreach ($printedphoto as $item)
                                                    <option value="{{ $item->id }}" data-bs-harga-pp="{{ $item->price }}">
                                                        {{ $item->printedphoto }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 text-center">
                                            <label for="print_quantity" class="mb-1 text-secondary small">Qty</label>
                                            <input type="text" class="form-control" name="ppqty" id="print_quantity"
                                                value="" required style="height: 70%">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label class="mb-1 text-secondary" for="photobook_id">Photobook</label>
                                            <select class="form-control text-secondary small" name="photobook_id"
                                                id="photobook_id" style="height: 70%">
                                                @foreach ($photobook as $item)
                                                    <option value="{{ $item->id }}" data-bs-harga-pb="{{ $item->price }}">
                                                        {{ $item->photobook }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 text-center">
                                            <label for="photobook_quantity" class="mb-1 text-secondary small">Qty</label>
                                            <input type="text" class="form-control" name="pbqty" id="photobook_quantity"
                                                value="" required style="height: 70%">
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="mb-1 text-secondary">Additional Service</p>
                                        </div>
                                    </div>

                                    <div class="row text-secondary">
                                        @foreach ($additionals as $additional)
                                            <div class="col-md-6">
                                                <label class="container-checkbox">{{ $additional->name }}
                                                    <input type="checkbox" id="additionals" name="additionals[]" value="{{ $additional->id }}"
                                                           data-price="{{ $additional->price }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row justify-content-center mb-4">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <button type="button" class="btn btn-kalografi btn-block" data-bs-toggle="modal"
                                                data-bs-target="#total_modal" data-bs-url="{{ route('post-custom') }}"
                                                onclick="calculate()">
                                                Calculate Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-5" style="background-color: #FAFBFA">
        <div class="container">

        </div>
    </div>

    {{-- START CALCULATE MODAL --}}
    <div class="modal fade" id="total_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content p-4" style="border-radius: 15px">
                <div class="modal-body">
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-4">
                            <img src="{{ asset('placeholders/checked 1.png') }}" alt="checked">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <p class="text-secondary text-bold fs-4">
                            Your Bill is :
                        </p> <br>
                        <p class="text-secondary text-bold fs-4" id="total_price_modal"></p>

                    </div>
                    <div class="row text-center ">
                        <div class="col">
                            <button type="button" class="btn btn-kalografi btn-sm"
                                onclick="event.preventDefault(); document.getElementById('total_form').submit();"
                                style="width: 60%; height:120%; border-radius:10px">
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END CALCULATE MODAL --}}

    <script>
        let total_price;
        let totalPriceInRupiah;
        let additionalPrice = 0;
        const cbs = document.querySelectorAll('input[type=checkbox]');

        function numberToRupiah(number) {
            const format = number.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            return convert.join(',').split('').reverse().join('');
        }

        for (let i = 0; i < cbs.length; i++) {
            cbs[i].addEventListener('change', function() {
                if (this.checked) {
                    additionalPrice += parseInt(this.getAttribute('data-price'))
                } else {
                    additionalPrice -= parseInt(this.getAttribute('data-price'))
                }
            });
        }

        function calculate() {
            const photographerSelectedId = document.forms['total_form'].elements['photographer_id'].options[document.forms[
                'total_form'].elements['photographer_id'].selectedIndex].getAttribute('data-bs-harga-photo');
            const videographerSelectedId = document.forms['total_form'].elements['videographer_id'].options[document.forms[
                'total_form'].elements['videographer_id'].selectedIndex].getAttribute('data-bs-harga-video');
            const workHoursSelectedId = document.forms['total_form'].elements['workhour_id'].options[document.forms[
                'total_form'].elements['workhour_id'].selectedIndex].getAttribute('data-bs-workhoursprice');
            const printedPhotoSelectedId = document.forms['total_form'].elements['printedphoto_id'].options[document.forms[
                'total_form'].elements['printedphoto_id'].selectedIndex].getAttribute('data-bs-harga-pp');
            const printedPhotoQty = document.getElementById("print_quantity").value;
            const photoBookSelectedId = document.forms['total_form'].elements['photobook_id'].options[document.forms[
                'total_form'].elements['photobook_id'].selectedIndex].getAttribute('data-bs-harga-pb');
            const photoBookQty = document.getElementById("photobook_quantity").value;

            const photographerPrice = parseInt(photographerSelectedId);
            const videographerPrice = parseInt(videographerSelectedId);
            const printedPhotoPrice = parseInt(printedPhotoSelectedId);
            const photoBookPrice = parseInt(photoBookSelectedId);
            const workHoursPrice = parseInt(workHoursSelectedId);

            const printedPhotoTotal = printedPhotoPrice * printedPhotoQty;
            const photoBookTotal = photoBookPrice * photoBookQty;
            const packagePrice = photographerPrice + videographerPrice + workHoursPrice;
            total_price = packagePrice + printedPhotoTotal + photoBookTotal + additionalPrice;
            totalPriceInRupiah = numberToRupiah(total_price);

            document.getElementById('total_price_modal').innerHTML = "Rp. " + totalPriceInRupiah;
            document.getElementById('grand_total').value = total_price;
        }
    </script>

    @include(' layouts.partials.footer')
@endsection
