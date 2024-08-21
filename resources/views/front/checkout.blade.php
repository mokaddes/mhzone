@extends('front.layouts.master')
@section('title', __('Checkout'))
@section('meta')
    @php
        $data = metaData('home');
    @endphp
    <meta name="title" content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta name="description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title"
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta name=twitter:card content="{{ $data->image_url }}" />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.index') }}" />
    <meta name=twitter:title
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif" />
    <meta name=twitter:description
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@section('content')
    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-5 d-none d-sm-block">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Check Out</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->

    <!-- ============================== checkout ================================== -->

    <div class="checkout_section mb-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <div class="mb-3">
                <h4>Shipping Address</h4>
            </div>
            <form action="{{ route('frontend.order.place') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-md-flex justify-content-between">
                    <div class="row gy-5">
                        <div class="col-md-8">
                            <div class="payment_method coupon_form">
                                @if (isset($address) && $address->count() > 0)
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <select name="saved_address" id="saved_address_id" class="form-control">
                                                <option selected disabled>Select saved address</option>
                                                @foreach ($address as $value)
                                                    <option value="{{ $value->id }}">Address {{ $loop->index + 1 }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                                                class="form-control" placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="apartment" value="{{ old('apartment') }}"
                                                id="apartment" class="form-control" placeholder="Apartment" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="form-group text-end">
                                            <div class="filter_button">
                                                <input class="form-check-input d-none" type="radio" name="address_type"
                                                    value="home" id="home" checked>
                                                <label class="form-check-label address_from_label" for="home">
                                                    Home
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="address" id="address"
                                                value="{{ old('address') }}" class="form-control"
                                                placeholder="Address line" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="city" id="city" value="{{ old('city') }}"
                                                class="form-control" placeholder="City" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="form-group text-end">
                                            <div class="filter_button">
                                                <input class="form-check-input d-none" type="radio" name="address_type"
                                                    value="office" id="office">
                                                <label class="form-check-label address_from_label" for="office">
                                                    Office
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="state" id="state"
                                                value="{{ old('state') }}" class="form-control" placeholder="State"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <input type="number" name="postcode" value="{{ old('postcode') }}"
                                                id="postcode" class="form-control" placeholder="Zip Code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="form-group text-end">
                                            <div class="filter_button">
                                                <input class="form-check-input d-none" type="radio" name="address_type"
                                                    value="other" id="other">
                                                <label class="form-check-label address_from_label" for="other">
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="coupon">
                                {{--                                <div class="coupon_form mb-4"> --}}
                                {{--                                    <div class="d-flex justify-content-between"> --}}
                                {{--                                        <div class="input-group me-3"> --}}
                                {{--                                            <span class="input-group-text"><img src="assets/images/Ticket_use.png" --}}
                                {{--                                                                                alt=""></span> --}}
                                {{--                                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter Coupon Code"> --}}
                                {{--                                        </div> --}}
                                {{--                                        <button type="button" id="coupon_submit" onclick="applyCoupon('{{ route('frontend.couponApply') }}')"  class="btn btn-primary">Apply</button> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}
                                <div class="order_table mb-5">
                                    <h3>Price Details</h3>
                                    <table class="table">
                                        <tr>
                                            <td>Cart total</td>
                                            <td><span>$ {{ cart_total() }}</span></td>
                                        </tr>
                                        <tr class="boder-bottom">
                                            <td>Shipping Charge</td>
                                            <td><span>$ {{ cart_shipping() }}</span></td>
                                        </tr>
                                        <tr class="boder-bottom discount_tr" style="display: none">
                                            <td>Discount</td>
                                            <td class="text-green"><span id="discount_charge">$ 0</span></td>
                                        </tr>
                                        <tr class="total_price">
                                            <td>Total</td>
                                            <td><span id="total_price">$ {{ cart_total(cart_shipping()) }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- @if (!empty($card))
                    <div class="payment_option d-block d-sm-none">
                        <div class="title">
                            <h3>Payment Option</h3>
                        </div>
                        <div class="payment_card_option">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="cart_name">
                                    <h5>{{ $card->card_name }}</h5>
                                </div>
                                <div class="cart_icon">
                                    <img src="{{ asset('front/assets/images/icons/credit-cart.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="cart_number">
                                <h5>{{ $card->card_number }}</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="cart_number">
                                    <h5>{{ $card->cvc }}</h5>
                                </div>
                                <div class="cart_date">
                                    <h5>{{ $card->exp_month }}/{{ $card->exp_year }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}

                <div class="row gy-5 mt-lg-5 align-items-center">
                    <div class="col-md-10 col-lg-6 m-auto">
                        <div class="payment_option mb-3 mt-4 d-block d-md-none">
                            <div class="title">
                                <h3>Payment Option</h3>
                            </div>
                        </div>
                        <div class="payment_card">
                            <section class="card checkout_card" id="card">
                                <div class="front">

                                    <div class="brand-logo" id="brand-logo">
                                        @if (isset($card) && $card->card_type == 'MasterCard')
                                            <img src="https://raw.githubusercontent.com/falconmasters/formulario-tarjeta-credito-3d/master/img/logos/mastercard.png"
                                                alt="">
                                        @else
                                            <img src="https://raw.githubusercontent.com/falconmasters/formulario-tarjeta-credito-3d/master/img/logos/visa.png"
                                                alt="">
                                        @endif
                                    </div>
                                    <img src="https://raw.githubusercontent.com/falconmasters/formulario-tarjeta-credito-3d/master/img/chip-tarjeta.png"
                                        class="chip">
                                    <div class="details">
                                        <div class="group" id="number">
                                            <p class="label">Card Number</p>
                                            <p class="number">
                                                {{ isset($card->card_number) ? cardNumberFormat($card->card_number) : '#### #### #### ####' }}
                                            </p>
                                        </div>
                                        <div class="flexbox">
                                            <div class="group" id="name">
                                                <p class="label"> Card's Holder </p>
                                                <p class="name">{{ $card->card_name ?? 'John Doe' }}</p>
                                            </div>
                                            <div class="group" id="expiration">
                                                <p class="label">Expiration</p>
                                                <p class="expiration"><span
                                                        class="month">{{ $card->exp_month ?? 'MM' }}</span> / <span
                                                        class="year">{{ $card->exp_year ?? 'YY' }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="back">
                                    <div class="magnetic-bar mb-2"></div>
                                    <div class="details">
                                        <div class="group" id="signature">
                                            <p class="label">Signature</p>
                                            <div class="signature">
                                                <p>{{ $card->card_name ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="group" id="ccv">
                                            <p class="label">CCV</p>
                                            <p class="ccv">{{ $card->cvc ?? '' }}</p>
                                        </div>
                                    </div>
                                    <p class="legend">This card is the property of xyz bank limited.
                                        By accepting signing or using this card, you agree to be the terms & conditions
                                        the use of this card when issued angd as amended time to time.
                                    </p>
                                </div>
                            </section>

                            <div class="d-flex justify-content-between mt-3 container-fluid">
                                <div class="select_cart user_card {{ isset($card) ? '' : 'd-none' }}">
                                    <div class="form-check ">
                                        <input type="radio" name="payment_method" class="form-check-input"
                                            value="stripe" id="selectCard">
                                        <label class="form-check-label add_new" for="selectCard"><span>Select
                                                Card</span></label>
                                    </div>
                                </div>
                                <div class="add_new user_card {{ isset($card) ? '' : 'd-none' }}">
                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#cardModal">Update
                                        Card</a>
                                </div>
                                <div class="no_card {{ !isset($card) ? '' : 'd-none' }} ">
                                    <div class="add_new">
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#cardModal">Add new</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 mb-5 mb-lg-0 d-none d-sm-block">
                        <div class="divier_option text-center">
                            <span>OR</span>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="payment_method text-center">
                            <div class="title d-none d-sm-block">
                                <h3>Select Payment Method</h3>
                            </div>
                            <div class="payment_btn mb-4">
                                <input type="radio" name="payment_method" id="paypal" value="paypal">
                                <label for="paypal" class="form-check-label">
                                    <img src="{{ asset('front/assets/images/paypal.png') }}" alt="paypal">
                                    Express buy with Paypal
                                </label>
                                {{-- <input type="radio" name="payment_method" id="apple" value="apple">
                                <label for="apple" class="form-check-label">
                                    <img src="{{ asset('front/assets/images/applePay.png') }}" alt="applePay">
                                    Express buy with Apple Pay
                                </label> --}}
                            </div>
                            <div class="checkout_btn">
                                <div class="d-none d-sm-block">
                                    <button type="submit" class="btn btn-primary">Pay</button>
                                </div>
                                <div class="d-block d-sm-none">
                                    <button type="submit" class="btn btn-primary">Pay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="subtotal" id="cart_total_input" value="{{ cart_total() }}">
                <input type="hidden" name="shipping_charge" id="delivery_charge_input" value="{{ cart_shipping() }}">
                <input type="hidden" name="coupon_discount" id="discount_input" value="0">
                <input type="hidden" name="total_price" id="total_price_input"
                    value="{{ cart_total(cart_shipping()) }}">
            </form>
        </div>
    </div>
    <!-- ============================== checkout ================================== -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="cardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cardModalLabel">User Card</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('frontend.user.card.store') }}" id="card-form" method="post"
                    class="card-form active">
                    <div class="modal-body">
                        @csrf
                        <div class="group">
                            <label for="inputNumber">Card Number</label>
                            <input type="text" id="inputNumber" name="card_number"
                                value="{{ isset($card->card_number) ? cardNumberFormat($card->card_number) : old('card_number') }}"
                                maxlength="19" autocomplete="off">
                        </div>
                        <div class="group">
                            <label for="inputHolder">Card's Holder Name</label>
                            <input type="text" id="inputHolder" name="card_name"
                                value="{{ old('name') ?? ($card->card_name ?? '') }}" maxlength="19" autocomplete="off">
                        </div>
                        <div class="flexbox">
                            <div class="group expire">
                                <label for="selectMonth">Expiration</label>
                                <div class="flexbox">
                                    <div class="group-select">
                                        <select name="exp_month" id="selectMonth">
                                            <option disabled selected> Month</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ isset($card->exp_month) && $card->exp_month == $i ? 'selected' : '' }}>
                                                    {{ $i }} </option>
                                            @endfor
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                    <div class="group-select">
                                        <select name="exp_year" id="selectYear">
                                            <option disabled selected> Year</option>
                                            @for ($i = date('Y'); $i <= date('Y') + 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ isset($card->exp_year) && $card->exp_year == $i ? 'selected' : '' }}>
                                                    {{ $i }} </option>
                                            @endfor
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="group ccv">
                                <label for="inputCCV">CVC</label>
                                <input type="text" name="cvc" id="inputCCV"
                                    value="{{ old('cvc') ?? ($card->cvc ?? '') }}" maxlength="3">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success card_submit"> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('front/css/card.css') }}">
    <style>
        input[type="radio"]:checked+.address_from_label {
            background: rgb(217, 217, 217);
        }

        .address_from_label {
            position: relative;
            margin: 4px 1px;
            font-family: JetBrains Mono;
            cursor: pointer;
            background: #fff;
            border: 1px solid #d6d6d6;
            border-radius: 12px;
            font-style: normal;
            font-weight: 400;
            letter-spacing: .125em;
            font-size: 17px;
            padding: 10px 12px;
            text-align: center;
            min-width: 126px;
        }

        .non_width_btn {
            width: auto !important;
            padding: 15px 25px !important;
        }

        .payment_method.coupon_form .form-control {
            border-left: 1px solid #b0b0b0 !important;
        }

        .card-form {
            background: none !important;
            position: initial !important;
            padding: 0px !important;
        }
    </style>
@endpush
@push('js')
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="{{ asset('front/js/card.js') }}" crossorigin="anonymous"></script>
    <script>
        function applyCoupon(url) {
            let code = $('#coupon_code').val();
            // let delivery = $('#delivery_charge_input').val();
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    coupon_code: code,
                    // delivery: delivery,
                },
                success: function(data) {

                    console.log(data)
                    if (data.status == 'error') {
                        toastr.error(data.message);
                    } else {
                        toastr.success(data.message);
                        $('.discount_tr').show();
                        $('#discount_charge').text('$ ' + data.discount.toFixed(2));
                        $('#total_price').text('$ ' + data.couponTotal.toFixed(2));
                        $('#discount_input').val(data.discount.toFixed(2));
                        $('#total_price_input').val(data.couponTotal.toFixed(2));
                        $('#coupon_code').attr('readonly', true);
                        $('#coupon_submit').attr('disabled', true);
                    }
                },
            });
        }

        $("#apple").on("change", function() {
            alert('Coming soon.');
            $('#apple').prop('checked', false);
        });
        $("#saved_address_id").on("change", function() {
            var saved_address_id = $(this).val();
            console.log(saved_address_id);
            $.ajax({
                method: "get",
                url: "{{ route('frontend.getSavedAddress') }}",
                data: {
                    id: saved_address_id
                },
                success: function(res) {
                    console.log(res);
                    $('#phone').val(res.phone);
                    $('#apartment').val(res.apartment);
                    $('#address').val(res.address);
                    $('#city').val(res.city);
                    $('#state').val(res.state);
                    $('#postcode').val(res.postcode);
                    if (res.address_type == 'home') {
                        $('#home').prop('checked', true)
                    }

                    if (res.address_type == 'office') {
                        $('#office').prop('checked', true)
                    }

                    if (res.address_type == 'other') {
                        $('#other').prop('checked', true)
                    }
                }
            });

        });

        $('#card-form').submit(function(e) {
            e.preventDefault();
            let data = $('#card-form').serialize();
            $.ajax({
                method: "POST",
                url: '{{ route('frontend.user.card.store') }}',
                data: data,
                success: function(data) {
                    if (data.error) {
                        printErrorMsg(data.error)
                    } else {
                        $('.user_card').removeClass('d-none');
                        $('.no_card').addClass('d-none');
                        toastr.success('Card saved successfully');
                        $('#cardModal').modal('hide');
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $.each(msg, function(key, value) {
                toastr.error(value)
            });
        }
    </script>
@endpush
