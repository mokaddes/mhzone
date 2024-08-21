@extends('front.layouts.master')
@section('title', __('Order Success'))
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
    <div class="breadcrumb mb-5 d-none d-sm-block">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Order successfully placed </h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->




    <!-- ==============================  order details ================================== -->
    <div class="order_details pb-4">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="order text-center">
                        <div class="mb-5">
                            <img src="{{ asset('front/assets/images/done.svg') }}" width="420" class="img-fluid"
                                 alt="image">
                        </div>
                        <h3>Your Order is Confirmed</h3>
                        <p>Order ID {{ '#' .$order->order_number }}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order_table mb-5">
                        <table class="table">
                            <tr>
                                <td>Order Details</td>
                            </tr>
                            @foreach($order->orderDetails as $orderDetail )
                                <tr>
                                    <td>{{ $orderDetail->ad->title }}({{$orderDetail->quantity}})</td>
                                    <td><span>$ {{ $orderDetail->total_price }}</span></td>
                                </tr>
                            @endforeach
                            {{--                            <tr>--}}
                            {{--                                <td>Discount</td>--}}
                            {{--                                <td><span class="text-green">$ 2,99.00</span></td>--}}
                            {{--                            </tr>--}}
                            <tr class="boder-bottom">
                                <td>Shipping Charge</td>
                                <td><span>$ {{ $order->shipping_charge }}</span></td>
                            </tr>
                            <tr class="total_price">
                                <td>Total</td>
                                <td><span
                                        class="{{ $order->transaction->payment_status == 1 ? 'text-success' : 'text-danger' }}">$ {{ $order->total_price }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="{{ $order->transaction->payment_status == 1 ? 'text-success' : 'text-danger' }}">
                                    Payment
                                </td>
                                <td class="{{ $order->transaction->payment_status == 1 ? 'text-success' : 'text-danger' }}">
                                    <span>{{ $order->transaction->payment_status == 1 ? 'Paid' : 'Unpaid' }}</span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="delivery_address">
                        <div class="mb-3">
                            <h3>Shipping Address ({{ strtoupper($order->address_type) }})</h3>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <span>{{ $order->buyer->name?? "" }}</span>
                                <br>
                                <span>{{ $order->apartment }} {{ $order->address }} , {{ $order->city }}</span>
                                <br>
                                <span>{{ $order->state }}-{{ $order->postcode }}</span>
                                <br>
                                <span>Mobile-{{ $order->phone ?? $order->buyer->phone }}</span>
                            </div>
                            <div class="">
                                <p>
                                    <span class="text-end d-block d-sm-none">
                                        <strong>Deliver Here</strong>
                                    </span>
                                    <span class="text-end d-block d-sm-none">Other</span>
                                </p>
                            </div>
                        </div>


                    </div>

                </div>


                <div class="back_home text-center d-block d-sm-none mt-5 mb-3">
                    <a href="{{ route('frontend.index') }}">Back to Home</a>
                </div>

            </div>
        </div>
    </div>
    <!-- ==============================  order details ================================== -->

@endsection
@push('css')
    <style>
        .order_table tr td:first-child {
            width: 65%;
        }
    </style>
@endpush
