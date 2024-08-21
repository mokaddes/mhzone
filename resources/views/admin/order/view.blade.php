@extends('admin.order.order-layout')


@section('title')
    {{ __('Order Details') }}
@endsection

@section('website-orders')
    <div class="order_section">
        <div class="container">
            <div class="card mb-3">
                <div class="card-header border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="align-content-center">
                            <strong class="text-success">Invoice No: #{{ $order->order_number }}</strong>
                            <br>
                            <span>Placed On: {{ date('d M Y, h:i:s A', strtotime($order->created_at)) }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            @if (is_seller())
                                <a href="{{ route('frontend.user.invoice') }}" class="btn btn-sm download_order"><i
                                        class="fas fa-file-download" style="font-size: 32px"></i></a>
                            @else
                                <h5 class="mt-3">Total Price: <strong>${{ $order->total_price }}</strong></h5>
                            @endif
                        </div>
                    </div>

                    {{-- <h5 class="float-right">Total Price</h5>
                <p>Invoice No: {{ $orderDetails->order->order_number }} </p>
                <p>Placed On: {{ date('d M Y, h:i:s A',strtotime($orderDetails->order->created_at)) }}</p> --}}

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    @foreach ($orderDetails as $seller_id => $itemGroup)
                        <div class="card mb-4">
                            <div class="card-header mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="align-items-center">
                                        <h5>
                                            <a class="text-black"
                                                href="{{ route('frontend.seller.shop', $itemGroup->seller->userShop->slug) }}">{{ $itemGroup->seller->userShop->name }}</a>
                                        </h5>
                                        <span>Shipping Charge:
                                            <strong>${{ $order->shipping_charge / $order->total_seller }}</strong>
                                        </span>
                                    </div>
                                    <div class="align-items-center">
                                        <h5 class="mt-3">{{ is_seller() ? 'Total Price' : 'Shop Total' }} :
                                            <strong>${{ $itemGroup->sum('total_price') + $order->shipping_charge / $order->total_seller }}</strong>
                                        </h5>
                                        @if (Auth::user()->can('admin.order.changeStatus'))
                                            <div class="change-status">
                                                <form action="{{ route('admin.order.changeStatus', $order->id) }}"
                                                    method="post" id="statusForm">
                                                    @csrf
                                                    <input type="hidden" name="seller_id" value="{{ $seller_id }}">
                                                    <select name="status" id="orderStatus"
                                                        onchange="document.getElementById('statusForm').submit();"
                                                        class="form-control form-select">
                                                        <option selected disabled>Change Status</option>
                                                        <option value="confirmed"
                                                            {{ $itemGroup->first()->status == 'confirmed' ? 'selected' : '' }}>
                                                            Confirmed
                                                        </option>
                                                        <option value="processing"
                                                            {{ $itemGroup->first()->status == 'processing' ? 'selected' : '' }}>
                                                            Processing
                                                        </option>
                                                        <option value="shipped"
                                                            {{ $itemGroup->first()->status == 'shipped' ? 'selected' : '' }}>
                                                            Shipped
                                                        </option>
                                                        <option value="delivered"
                                                            {{ $itemGroup->first()->status == 'delivered' ? 'selected' : '' }}>
                                                            Delivered
                                                        </option>
                                                    </select>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="product_tracking">

                                        <div class="tracking-progress">
                                            <div
                                                class="tracking-step {{ in_array($itemGroup->first()->status, ['pending', 'confirmed', 'processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                                <div class="tracking-icon"><i class="fas fa-spinner"></i></div>
                                                <div class="tracking-title">Order Placed</div>
                                            </div>
                                            <div
                                                class="tracking-step {{ in_array($itemGroup->first()->status, ['confirmed', 'processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                                <div class="tracking-icon"><i class="fa fa-clipboard-check"></i></div>
                                                <div class="tracking-title">Order Confirmed</div>
                                            </div>
                                            <div
                                                class="tracking-step {{ in_array($itemGroup->first()->status, ['processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                                                <div class="tracking-icon"><i class="fa fa-box"></i></div>
                                                <div class="tracking-title">Processing</div>
                                            </div>
                                            <div
                                                class="tracking-step {{ in_array($itemGroup->first()->status, ['shipped', 'delivered']) ? 'active' : '' }}">
                                                <div class="tracking-icon"><i class="fa fa-truck"></i></div>
                                                <div class="tracking-title">Shipped</div>
                                            </div>
                                            <div
                                                class="tracking-step {{ $itemGroup->first()->status == 'delivered' ? 'active' : '' }}">
                                                <div class="tracking-icon"><i class="fa fa-clipboard-check"></i></div>
                                                <div class="tracking-title">Delivered</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="custom-style-order">
                                    <h6 class="text-center">Shipping Address</h6>
                                    <p class="text-center w-50 container-fluid">
                                        <strong class="mt-1">Name
                                            :</strong> {{ $order->buyer->name ?? '' }}
                                        <br>
                                        {{ $order->apartment }} {{ $order->address }}, {{ $order->city }},
                                        {{ $order->state }} - {{ $order->postcode }}
                                        <br>
                                        <strong class="mt-1">Phone
                                            :</strong> {{ $order->phone ?? $order->buyer->phone }}
                                    <div class="text-center">
                                        {{ ucfirst($itemGroup->first()->status) }} :
                                        {{ date('d M Y, h:i:s A', strtotime($itemGroup->first()->updated_at)) }}
                                    </div>
                                    </p>
                                </div>

                                @foreach ($itemGroup as $item)
                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <div class="d-flex position-relative">
                                            <img src="{{ asset($item->ad->thumbnail ?? 'front/no-image.png') }}"
                                                width="65" height="65" class="flex-shrink-0 me-3" alt="...">
                                            <div>
                                                <h5 class="mt-0">{{ $item->ad->title }} </h5>
                                                @if (isset($item->ad->attrs) && $item->ad->attrs->count() > 0)
                                                    @foreach ($item->ad->attrs as $attr)
                                                        {{ $attr->parent_attr->name }} :
                                                        @foreach (json_decode($attr->attr_details, true) as $name => $price)
                                                            {{ $name }} {{ $loop->last ? '' : ',' }}
                                                        @endforeach
                                                        {{ $loop->last ? '' : '|' }}
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <h5>${{ $item->total_price }}</h5>
                                        <h5>QTY: {{ $item->quantity }}</h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


@section('style')
    <style>
        .fa {
            z-index: 9999999;
        }

        .tracking {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .tracking-progress {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .tracking-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 20%;
        }

        .tracking-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            background-color: #f1f1f1;
            border-radius: 50%;
            margin-bottom: 10px;
            font-size: 20px;
            color: #666;
        }

        .tracking-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            color: #666;
        }

        .tracking-step.active .tracking-icon {
            background-color: #007bff;
            color: #fff;
        }

        .tracking-step.active .tracking-title {
            color: #007bff;
        }

        .tracking-details {
            display: flex;
            flex-direction: column;
        }

        .tracking-status {
            display: flex;
            margin-bottom: 10px;
        }

        .tracking-status-title {
            font-size: 14px;
            font-weight: bold;
            margin-right: 10px;
            color: #333;
        }

        .tracking-status-value {
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
        }

        .tracking-date {
            display: flex;
            margin-bottom: 10px;
        }

        .tracking-date-title {
            font-size: 14px;
            font-weight: bold;
            margin-right: 10px;
            color: #333;
        }

        .tracking-date-value {
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
        }

        .tracking-location {
            display: flex;
            margin-bottom: 10px;
        }

        .tracking-location-title {
            font-size: 14px;
            font-weight: bold;
            margin-right: 10px;
            color: #333;
        }

        .tracking-location-value {
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
        }

        .custom-style-order {
            width: 100%;
            padding: 26px 23px;
            margin-top: 41px;
            background: gainsboro;
            border: 2px solid #dbd2d2;
        }
    </style>
@endsection

@section('script')
@endsection
