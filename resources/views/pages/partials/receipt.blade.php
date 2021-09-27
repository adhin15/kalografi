<div class="col-md-5">
    <div class="card px-5 py-3" style="border-radius: 20px;" data-aos="fade-left" data-aos-delay="100" data-aos-duration="500">
        <div class="card-body">
            <div class="row text-center">
                <h3 class="fs-3 fw-bold text-kalografi mb-3">
                    @if ($booking->paket_id == 0)
                        Custom Package
                    @else
                        {{ $booking->pakets->namapaket }}
                        <br>
                        {{ $booking->pakets->kategori }}
                    @endif
                </h3>
            </div>

            @if ($booking->id !== null)
                <div class="row text-center">
                    <p class="text-secondary fs-6">Order ID : <strong>{{ $booking->id }}</strong></p>
                </div>
            @endif

            <div class="row text-center">
                <p class="text-secondary">
                    Booking Date <strong>{{ date_format(date_create($booking->bookdate), 'd F Y') }}</strong>
                </p>
            </div>

            <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">

            <div class="row" style="font-size: 14px">
                <p class="semi-bold text-secondary fs-5">Customer Details</p>

                <div class="row">
                    <div class="col-md-6">
                        <p class="text-secondary mb-2">Name</p>
                    </div>
                    <div class="col-md-6 pe-0">
                        <p class="text-secondary mb-2" id="previewnama">{{ $booking->fullname }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p class="text-secondary mb-2">Email</p>
                    </div>
                    <div class="col-md-6 pe-0">
                        <p class="text-secondary mb-2" id="previewemail">{{ $booking->email }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p class="text-secondary mb-2">Phone Number</p>
                    </div>
                    <div class="col-md-6 pe-0">
                        <p class="text-secondary mb-2" id="previewnomor">{{ $booking->phonenumber }}</p>
                    </div>
                </div>
            </div>

            <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">

            <div class="row mt-2 text-center mb-4 justify-content-center" style="font-size: 14px">
                <p class="semi-bold text-secondary fs-5">Order Details</p>
                <div class="col-md-4">
                    <button id="previewvenue" class="btn btn-sm semi-bold fs-7 btn-outline-kalografi" disabled
                        style="width: 100%">
                        {{ $booking->venue }}
                    </button>
                </div>

                <div class="col-md-4">
                    <button id="previewtone" class="btn btn-sm semi-bold fs-7 btn-outline-kalografi" disabled
                        style="width: 100%">
                        {{ $booking->tone }}
                    </button>
                </div>
                <div class="col-md-4">
                    <button id="previewweddingstyle" disabled class="btn btn-sm semi-bold fs-7 btn-outline-kalografi"
                        style="width: 100%">
                        {{ $booking->weddingstyle }}
                    </button>
                </div>
            </div>

            <div class="row mb-3 justify-content-between align-items-center" style="font-size: 14px">
                <div class="col-md-2">
                    <input type="text" class="form-control form-control-sm text-center" name="package_qty"
                        id="package_qty" value="1" aria-label="package_qty" style="width: 40px;" disabled>
                </div>

                <div class="col-md-6 px-0">
                    <p class="text-secondary mb-0">
                        @if ($booking->paket_id == 0)
                            Custom Package
                        @else
                            {{ $booking->pakets->namapaket }}

                            {{ $booking->pakets->kategori }}
                        @endif
                    </p>
                </div>
                <div class="col-md-4">
                    <p id="pricepackage" class="semi-bold text-secondary mb-0 text-end">
                        @if ($booking->paket_id == 0)
                            @if($additionals)
                                Rp. {{ number_format(($booking->totalprice - ($pp->price * $booking->ppqty + $pb->price * $booking->pbqty)) - $additionals->sum('price')) }}
                            @else
                                Rp. {{ number_format($booking->totalprice - ($pp->price * $booking->ppqty + $pb->price * $booking->pbqty)) }}
                            @endif
                        @else
                            Rp. {{ number_format($booking->pakets->price) }}
                        @endif
                    </p>
                </div>
            </div>

            <div class="row mb-3 justify-content-between align-items-center" style="font-size: 14px">
                <div class="col-md-2">
                    <input type="text" class="form-control form-control-sm text-center" name="print_quantity"
                        id="print_quantity" value="{{ $booking->ppqty }}" aria-label="print_quantity"
                        style="width: 40px;" disabled>
                </div>

                <div class="col-md-6 px-0">
                    <p class="text-secondary mb-0">
                        {{ $booking->printedphotos->printedphoto }}
                    </p>
                </div>

                <div class="col-md-4">
                    <p id="priceprintedphoto" class="semi-bold text-secondary mb-0 text-end">
                        Rp. {{ number_format($pp->price * $booking->ppqty) }}
                    </p>
                </div>
            </div>

            <div class="row mb-4 justify-content-between align-items-center" style="font-size: 14px">
                <div class="col-md-2">
                    <input type="text" class="form-control form-control-sm text-center" name="photobook_quantity"
                        id="photobook_quantity" value="{{ $booking->pbqty }}" aria-label="photobook_quantity"
                        style="width: 40px;" disabled>
                </div>

                <div class="col-md-6 px-0">
                    <p class="text-secondary mb-0">
                        {{ $booking->photobooks->photobook }}
                    </p>
                </div>

                <div class="col-md-4">
                    <p id="pricephotobook" class="semi-bold text-secondary mb-0 text-end">
                        Rp. {{ number_format($pb->price * $booking->pbqty) }}
                    </p>
                </div>
            </div>

            <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">

            @if($additionals)
                <div class="row mt-2 text-center justify-content-center">
                    <p class="semi-bold text-secondary fs-5">Additional Services</p>
                </div>

                @foreach($additionals as $item)
                    <div class="row mb-3 justify-content-between align-items-center" style="font-size: 14px">
                        <div class="col-md-2">
                            <input type="text" class="form-control form-control-sm text-center" name="photobook_quantity"
                                   id="photobook_quantity" value="1" aria-label="photobook_quantity"
                                   style="width: 40px;" disabled>
                        </div>

                        <div class="col-md-6 px-0">
                            <p class="text-secondary mb-0">
                                {{ $item->name }}
                            </p>
                        </div>

                        <div class="col-md-4">
                            <p id="priceprintedphoto" class="semi-bold text-secondary mb-0 text-end">
                                Rp. {{ number_format($item->price) }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">
            @endif

            <div id="discountDiv" style="display: none;">
                <div class="row mb-2 justify-content-between align-items-center" style="font-size: 14px;">
                    <div class="col-md-6 px-0">
                        <p class="text-secondary mb-0 ps-3" id="discountText"></p>
                    </div>
                    <div class="col-md-4">
                        <p class="semi-bold text-secondary mb-0 text-end" id="discountPrice"></p>
                    </div>
                </div>

                <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">
            </div>

            <div id="downPaymentDiv" style="display: none;">
                <div class="row mb-2 justify-content-between align-items-center" style="font-size: 14px;">
                    <div class="col-md-6 px-0">
                        <p class="text-secondary mb-0 ps-3" id="downPaymentText"></p>
                    </div>
                    <div class="col-md-4">
                        <p class="semi-bold text-secondary mb-0 text-end" id="downPaymentAmount"></p>
                    </div>
                </div>

                <div class="row mb-4 justify-content-between align-items-center" style="font-size: 14px;">
                    <div class="col-md-6 px-0">
                        <p class="text-secondary mb-0 ps-3" id="installmentText"></p>
                    </div>
                    <div class="col-md-4">
                        <p class="semi-bold text-secondary mb-0 text-end" id="installmentAmount"></p>
                    </div>
                </div>

                <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">
            </div>

            <div class="row mb-4 mt-4">
                <div class="col-md-6">
                    <img src="{{ asset('placeholders/visa.png') }}" alt="visa">
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <p class="semi-bold text-secondary text-end mb-0">Total</p>
                    </div>
                    <div class="row">
                        <p id="total" class="semi-bold fs-5 text-secondary mb-0 text-end">
                            Rp. {{ number_format($booking->totalprice) }}
                        </p>
                        <input type="hidden" id="id_diskon" name="discount_id" value="">
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-lg btn-kalografi semi-bold btn-block">
                    Continue to payment
                </button>
            </div>
        </div>
    </div>
</div>
