@extends('layouts.guest.master')
@section('content')
    <div class="container-fluid py-5" style="background-color: #FAFBFA">
        <form action="{{ route('store-booking') }}" method="post" id="form_discount">
            {{ csrf_field() }}
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <h3 class="fs-1 fw-bold text-secondary">Payment Details</h3>
                        </div>

                        <div class="row">
                            <p class="text-secondary">
                                We receive payments from bank transfer :
                            </p>
                        </div>

                        <div class="row mb-4">
                            <div class="col pe-0" data-aos="fade-right" data-aos-delay="500" data-aos-duration="500">
                                <img src="{{ asset('placeholders/ico_mastercard@2x 1.png') }}" alt="mastercard-icon">
                            </div>
                            <div class="col px-0" data-aos="fade-right" data-aos-delay="450" data-aos-duration="500">
                                <img src="{{ asset('placeholders/ico_visa@2x 1.png') }}" alt="mastercard-icon">
                            </div>
                            <div class="col px-0" data-aos="fade-right" data-aos-delay="400" data-aos-duration="500">
                                <img src="{{ asset('placeholders/ico_bca@2x 1.png') }}" alt="mastercard-icon">
                            </div>
                            <div class="col px-0" data-aos="fade-right" data-aos-delay="350" data-aos-duration="500">
                                <img src="{{ asset('placeholders/ico_mandiri@2x 1.png') }}" alt="mastercard-icon">
                            </div>
                            <div class="col px-0" data-aos="fade-right" data-aos-delay="300" data-aos-duration="500">
                                <img src="{{ asset('placeholders/ico_permata@2x 1.png') }}" alt="mastercard-icon">
                            </div>
                            <div class="col px-0" data-aos="fade-right" data-aos-delay="250" data-aos-duration="500">
                                <img src="{{ asset('placeholders/ico_bri@2x 1.png') }}" alt="mastercard-icon">
                            </div>
                            <div class="col ps-0" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500">
                                <img src="{{ asset('placeholders/ico_bni@2x 1.png') }}" alt="mastercard-icon">
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="form-group row mb-3">
                                <label for="bank" class="mb-1 text-secondary small">Payment Termination</label>
                                <div class="col" data-aos="fade-right" data-aos-delay="100"
                                    data-aos-duration="500">
                                    <select class="form-control text-secondary small" name="payment_termination"
                                        id="payment_termination" onchange="getPaymentType()">
                                        <option value="1">1x (Complete Payment)</option>
                                        <option value="2">2x (Down Payment & Complete Payment)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="redeem_code" class="mb-1 text-secondary small">Redeem Code</label>
                                <div class="col-md-8" data-aos="fade-right" data-aos-delay="100"
                                    data-aos-duration="500">
                                    <select class="form-control text-secondary small" name="discount_id" id="redeem_code"
                                        onchange="getSelectValue();">
                                        <option value="0" selected disabled>--Choose One--</option>
                                        @foreach ($discount as $item)
                                            <option value="{{ $item->id }}" data-bs-jumlah="{{ $item->amount }}">
                                                {{ strtoupper($item->name) . ' -- ' . $item->amount . '%' }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4" data-aos="fade-right" data-aos-delay="100"
                                    data-aos-duration="400">
                                    <button onclick="total_price()" class="btn btn-kalografi semi-bold" style="width: 100%"
                                        type="button">
                                        Get Discount
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <p class="text-secondary">
                                Note : <br>
                                After confirmation of payment we will send the invoice to
                                your phone number and email.
                            </p>
                        </div>
                    </div>

                    @include('pages.partials.receipt')
                </div>
            </div>
        </form>
    </div>
    @include('layouts.partials.footer')

    <script>
        const total = {{ $booking->total_price }};
        let selectedId;
        let selectedValue;
        let selectedPaymentType;
        let discountPrice;
        let totalPrice;
        let totalPriceInRupiah;

        function numberToRupiah(number) {
            const format = number.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            return convert.join(',').split('').reverse().join('');
        }

        function getSelectValue() {
            selectedValue = document.forms['form_discount'].elements['discount_id'].options[document.forms[
                'form_discount'].elements['discount_id'].selectedIndex].getAttribute('data-bs-jumlah');
            discountPrice = total * selectedValue / 100;
            totalPrice = total - discountPrice;
            totalPriceInRupiah = numberToRupiah(totalPrice);
        }

        discountPrice = total * selectedValue / 100;
        totalPrice = total - discountPrice;

        function getPaymentType() {
            selectedPaymentType = document.forms['form_discount'].elements['payment_termination'].options[document.forms[
                'form_discount'].elements['payment_termination'].selectedIndex].value;

            document.getElementById('downPaymentDiv').style.display = "none";

            if (selectedPaymentType === '2') {
                document.getElementById('downPaymentDiv').style.display = "";
                document.getElementById('downPaymentText').innerHTML = 'Down Payment';
                document.getElementById('downPaymentAmount').innerHTML = 'Rp. ' + numberToRupiah(totalPrice / 2);
                document.getElementById('installmentText').innerHTML = 'Installment';
                document.getElementById('installmentAmount').innerHTML = 'Rp. ' + numberToRupiah(totalPrice / 2);
            }
        }

        getSelectValue();

        function total_price() {
            getPaymentType()
            selectedId = document.forms['form_discount'].elements['discount_id'].options[document.forms[
                'form_discount'].elements['discount_id'].selectedIndex].value;

            if (selectedValue !== null) {
                document.getElementById('discountDiv').style.display = "";
                document.getElementById('discountText').innerHTML = 'Discount ' + selectedValue + '%';
                document.getElementById('discountPrice').innerHTML = '- Rp. ' + numberToRupiah(discountPrice);
            }
            document.getElementById("total").innerHTML = "Rp. " + totalPriceInRupiah;

        }
    </script>
@endsection
