<div class="col-md-5">
    <div class="card px-5 py-3" style="border-radius: 20px;" data-aos="fade-left" data-aos-delay="100"
        data-aos-duration="500">
        <div class="card-body">
            <div class="row text-center">
                <h3 class="fs-3 fw-bold text-kalografi mb-3">
                    @if ($booking->package_id === null)
                        Custom Package
                    @else
                        {{ $booking->package->name }}
                        <br>
                        {{ $booking->package->category }}
                    @endif
                </h3>
            </div>

            <div class="row text-center">
                <p class="text-secondary fs-6">Order ID : <strong>{{ $booking->order_id }}</strong></p>
            </div>

            <div class="row text-center">
                <p class="text-secondary">
                    Booking Date <strong>{{ date_format(date_create($booking->book_date), 'd F Y') }}</strong>
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
                        <p class="text-secondary mb-2" id="previewnama">{{ $booking->full_name }}</p>
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
                        <p class="text-secondary mb-2" id="previewnomor">{{ $booking->phone_number }}</p>
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
                        {{ $booking->wedding_style }}
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
                        @if ($booking->package_id === null)
                            Custom Package
                        @else
                            {{ $booking->package->name }}

                            {{ $booking->package->category }}
                        @endif
                    </p>
                </div>
                <div class="col-md-4">
                    <p id="pricepackage" class="semi-bold text-secondary mb-0 text-end">
                        @if ($booking->package_id == 0)
                            Rp. {{ number_format($booking->custom->price) }}
                        @else
                            Rp. {{ number_format($booking->package->price) }}
                        @endif
                    </p>
                </div>
            </div>

            <div class="row mb-3 justify-content-between align-items-center" style="font-size: 14px">
                <div class="col-md-2">
                    <input type="text" class="form-control form-control-sm text-center" name="print_quantity"
                        id="print_quantity" value="{{ $booking->printedphoto_qty }}" aria-label="print_quantity"
                        style="width: 40px;" disabled>
                </div>

                <div class="col-md-6 px-0">
                    <p class="text-secondary mb-0">
                        {{ $booking->printedphoto->name }}
                    </p>
                </div>

                <div class="col-md-4">
                    <p id="priceprintedphoto" class="semi-bold text-secondary mb-0 text-end">
                        Rp. {{ number_format($booking->printedphoto->price * $booking->printedphoto_qty) }}
                    </p>
                </div>
            </div>

            <div class="row mb-4 justify-content-between align-items-center" style="font-size: 14px">
                <div class="col-md-2">
                    <input type="text" class="form-control form-control-sm text-center" name="photobook_quantity"
                        id="photobook_quantity" value="{{ $booking->photobook_qty }}" aria-label="photobook_quantity"
                        style="width: 40px;" disabled>
                </div>

                <div class="col-md-6 px-0">
                    <p class="text-secondary mb-0">
                        {{ $booking->photobook->name }}
                    </p>
                </div>

                <div class="col-md-4">
                    <p id="pricephotobook" class="semi-bold text-secondary mb-0 text-end">
                        Rp. {{ number_format($booking->photobook->price * $booking->photobook_qty) }}
                    </p>
                </div>
            </div>

            <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">

            @if ($additionals)
                <div class="row mt-2 text-center justify-content-center">
                    <p class="semi-bold text-secondary fs-5">Additional Services</p>
                </div>

                @foreach ($additionals as $item)
                    <div class="row mb-3 justify-content-between align-items-center" style="font-size: 14px">
                        <div class="col-md-2">
                            <input type="text" class="form-control form-control-sm text-center"
                                name="photobook_quantity" id="photobook_quantity" value="1"
                                aria-label="photobook_quantity" style="width: 40px;" disabled>
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

            @if ($booking->discount)
                <div class="row mb-2 justify-content-between align-items-center" style="font-size: 14px;">
                    <div class="col-md-6 px-0">
                        <p class="text-secondary mb-0 ps-3" id="discountText">
                            {{ 'Discount ' . $booking->discount->amount . ' %' }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="semi-bold text-secondary mb-0 text-end" id="discountPrice">
                            {{ '-Rp. ' . number_format(($booking->total_price * (100 / (100 - $booking->discount->amount)) * $booking->discount->amount) / 100) }}
                        </p>
                    </div>
                </div>

                <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">
            @endif

            @if ($booking->payment_termination == 2)
                @if ($booking->payment_status === 'CREATED' || $booking->payment_status === 'DOWN_PAYMENT_PENDING' || $booking->payment_status === 'DOWN_PAYMENT_PAID' || $booking->payment_status === 'INSTALLMENT_PENDING')

                    <div class="row mt-4">
                        <div class="col-md-6"></div>

                        <div class="col-md-6">
                            <div class="row">
                                <p class="semi-bold text-secondary text-end mb-0">Total</p>
                            </div>

                            <div class="row">
                                <p id="total" class="semi-bold fs-5 text-secondary mb-0 text-end">
                                    Rp. {{ number_format($booking->total_price) }}
                                </p>
                            </div>

                            <div class="row" style="font-size: 14px;">
                                <p class="small text-secondary mb-0 text-end">
                                    @if ($booking->payment_status === 'CREATED' || $booking->payment_status === 'DOWN_PAYMENT_PENDING')
                                        2x Payment Left
                                    @elseif($booking->payment_status === 'DOWN_PAYMENT_PAID' ||
                                        $booking->payment_status === 'INSTALLMENT_PENDING')
                                        1x Payment Left
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px dashed black; background-color: #FFFFFF;">
                @endif
            @endif

            <div class="row mb-4 mt-4">
                <div class="col-md-6">
                    <img src="{{ asset('placeholders/visa.png') }}" alt="visa">
                </div>

                <div class="col-md-6">
                    @if ($booking->payment_termination == 2)
                        @if ($booking->payment_status === 'CREATED' || $booking->payment_status === 'DOWN_PAYMENT_PENDING')
                            <div class="row">
                                <p class="semi-bold text-secondary text-end mb-0">Down Payment</p>
                            </div>

                            <div class="row">
                                <p id="total" class="semi-bold fs-5 text-secondary mb-0 text-end">
                                    Rp. {{ number_format($booking->down_payment) }}
                                </p>
                            </div>
                        @elseif($booking->payment_status === 'DOWN_PAYMENT_PAID'|| $booking->payment_status ===
                            'INSTALLMENT_PENDING')
                            <div class="row">
                                <p class="semi-bold text-secondary text-end mb-0">Installment</p>
                            </div>

                            <div class="row">
                                <p id="total" class="semi-bold fs-5 text-secondary mb-0 text-end">
                                    Rp. {{ number_format($booking->installment) }}
                                </p>
                            </div>
                        @else
                            <div class="row">
                                <p class="semi-bold text-secondary text-end mb-0">Total</p>
                            </div>

                            <div class="row">
                                <p id="total" class="semi-bold fs-5 text-secondary mb-0 text-end">
                                    Rp. {{ number_format($booking->total_price) }}
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <p class="semi-bold text-secondary text-end mb-0">Total</p>
                        </div>

                        <div class="row">
                            <p id="total" class="semi-bold fs-5 text-secondary mb-0 text-end">
                                Rp. {{ number_format($booking->total_price) }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            @if ($booking->payment_status === 'CREATED')
                <div class="row">
                    <button type="submit" class="btn btn-lg btn-kalografi semi-bold btn-block" id="pay-button">
                        @if ($booking->payment_termination === 1)
                            Pay Now
                        @elseif($booking->payment_termination === 2)
                            Pay Down Payment
                        @endif
                    </button>
                </div>
            @elseif($booking->payment_status === 'FULL_PAYMENT_PENDING')
                <div class="row">
                    <button type="submit" class="btn btn-lg btn-kalografi semi-bold btn-block" id="pay-button">
                        Pay Now
                    </button>
                </div>
            @elseif($booking->payment_status === 'DOWN_PAYMENT_PENDING')
                <div class="row">
                    <button type="submit" class="btn btn-lg btn-kalografi semi-bold btn-block" id="pay-button">
                        Pay Down Payment
                    </button>
                </div>
            @elseif($booking->payment_status === 'DOWN_PAYMENT_PAID' || $booking->payment_status ===
                'INSTALLMENT_PENDING')
                <div class="row">
                    <button type="submit" class="btn btn-lg btn-kalografi semi-bold btn-block" id="pay-button">
                        Pay Installment
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('MIDTRANS_CLIENT_KEY') }}">
</script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('{{ $booking->payment_token }}');
    }
</script>
