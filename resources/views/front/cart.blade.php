@extends('front.layouts.master')
@section('title', __('Cart'))
@section('meta')
    @php
        $data = metaData('home');
    @endphp
    <meta name="title"
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif">
    <meta name="description"
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif">
    <meta property="og:image" content="{{ $data->image_url }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title"
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description"
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif">
    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}"/>
    <meta name=twitter:url content="{{ route('frontend.index') }}"/>
    <meta name=twitter:title
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif"/>
    <meta name=twitter:description
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif"/>
    <meta name=twitter:image content="{{ $data->image_url }}"/>
@endsection
@section('content')
    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-3 mb-sm-5">
        <div class="container">
            <div class="breadcrumb_name">
                <h3 class="d-none d-sm-block">Cart</h3>
                <h3 class="d-block d-sm-none">My Cart</h3>
                <p class="d-block d-sm-none">Products Checkout</p>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->

    <!-- ============================== cart ================================== -->
    <div class="cart_section">
        <div class="container">

            @if(isset($ads) && $ads->count() > 0)
                @foreach($ads as $item)
                    <div class="cart_product">
                        <div class="row gy-3 align-items-center text-center text-sm-start">
                            <div class="col-sm-4">
                                <div class="cart_img">
                                    <img src="{{ asset($item->thumbnail ?? 'front/no-image.png') }}" class="img-fluid"
                                         alt="image"
                                         style="width:200px;height: 150px">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="product_name text-center">
                                    <a href="{{ route('frontend.ad.details', $item->slug) }}">
                                        <h6 style="color:#5c5c5c;">{{ Str::limit($item->title, 90, '...') }}</h6>
                                    </a>
                                    <span> $ <span
                                            id="price_{{$item->id}}">{{ $cart[$item->id]['price'] }}</span> |  <span
                                            id="quantity_{{$item->id}}">{{$cart[$item->id]['quantity']}}</span> x | <span
                                            id="total_{{$item->id}}">{{ $cart[$item->id]['total_price'] }}</span> </span>
                                    <br>
                                    <span>
                                    @if(isset($cart[$item->id]['attr']))
                                            @foreach($cart[$item->id]['attr'] as $key => $val)
                                                {{ $key }} :
                                                @foreach($val as $details)
                                                    {{ $details['name'] }} {{ $loop->last ? '' : ',' }}
                                                @endforeach
                                                {{ $loop->last ? '' : '|' }}
                                            @endforeach
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="cart_qty float-sm-end">
                                    <div class="d-sm-flex align-items-center">
                                        <button class="incrementBtnR" id="plus{{$item->id}}" onclick="updateCart('{{ $item->id }}', 'plus')">
                                            +
                                        </button>
                                        <input type="text" class="incrementNum" data-qty="{{ $item->qty }}" name="qty" id="qty"
                                               value="{{ $cart[$item->id]['quantity'] }}" min="1"
                                               readonly>
                                        <button class="incrementBtnL" id="minus{{$item->id}}" onclick="updateCart('{{ $item->id }}', 'minus')">
                                            -
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


            <div class="d-md-flex justify-content-between">
                <div class="coupon">
                    {{--                    <div class="coupon_form mb-4">--}}
                    {{--                        <form action="#" method="post">--}}
                    {{--                            <div class="d-flex justify-content-between">--}}
                    {{--                                <div class="input-group me-3">--}}
                    {{--                                    <span class="input-group-text"><img src="assets/images/Ticket_use.png"--}}
                    {{--                                                                        alt=""></span>--}}
                    {{--                                    <input type="text" name="coupon_name" id="coupon_name" class="form-control"--}}
                    {{--                                           placeholder="Enter Coupon Code" required>--}}
                    {{--                                </div>--}}
                    {{--                                <button type="submit" class="btn btn-primary">Apply</button>--}}
                    {{--                            </div>--}}
                    {{--                        </form>--}}
                    {{--                    </div>--}}

                </div>
                <div class="payment-methods">
                    <div class="payment_method text-center float-md-end">
                        <div class="order_table mb-5">
                            <table class="table">
                                <tr class="boder-bottom">
                                </tr>
                                <tr class="total_price">
                                    <td>Cart total</td>
                                    <td>$ <span id="cart_total">{{ cart_total() }}</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="checkout_btn mb-5">
                            <div class="">
                                <a href="{{ route('frontend.checkout') }}" class="btn btn-primary">Checkout</a>
                            </div>
                            <!-- <div class="d-block d-sm-none">
                                <a href="#" class="btn btn-primary">Pay</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================== cart ================================== -->
@endsection

@push('js')
    <script>
        // Product Quantity
        $(document).ready(function () {
            // Decrease the quantity value by clicking the minus button
            $('.incrementBtnL').click(function () {
                let quantityInput = $(this).prev('input');
                let currentValue = parseInt(quantityInput.val());
                if (currentValue > 0) {
                    quantityInput.val(currentValue - 1);
                }
            });
            // Increase the quantity value by clicking the plus button
            $('.incrementBtnR').click(function () {
                let quantityInput = $(this).next('input');
                let currentValue = parseInt(quantityInput.val());
                let max = $(quantityInput).data('qty');
                // console.log(quantityInput);
                if (currentValue < max) {
                quantityInput.val(currentValue + 1);
                }
            });
        });

        function updateCart(id, type) {
            console.log(id, type)
            $.ajax({
                url: '{{ route('frontend.cart.update') }}',
                method: 'GET',
                data: {
                    id: id,
                    type: type,
                },
                beforeSend: function (data) {
                    $('body').css('cursor', 'wait');
                    $('#'+type+id).css('cursor', 'not-allowed');
                    $('#'+type+id).prop('disabled', true);
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == false) {
                        toastr.error('No more stock for now.');
                    }else if(data.reload == false){
                        toastr.success('Cart updated successfully');
                        $('#price_' + id).text(data.cart[id]['price'])
                        $('#quantity_' + id).text(data.cart[id]['quantity'])
                        $('#total_' + id).text((data.cart[id]['total_price']).toFixed(2))
                        $('#cart_total').text(data.cart_total.toFixed(2))
                    }else {
                        window.location.reload();
                    }
                },
                error: function (data) {
                    toastr.error('Something is wrong');
                },
                complete: function (data) {
                    $('body').css('cursor', 'auto');
                    $('#'+type+id).css('cursor', 'auto');
                    $('#'+type+id).prop('disabled', false);
                }
            });
        }

    </script>
@endpush
