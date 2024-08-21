@extends('front.layouts.master')
@section('title', __('My Order'))
@section('content')

    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-4">
        <div class="container">
            <div class="breadcrumb_name">
                <h3 class="text-center">Orders</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->

    <!-- ============================== order list ================================== -->
    <div class="order_section mb-5">
        <div class="container">
            @if (isset($orders) && $orders->count() > 0)
                @foreach ($orders as $order)
                    <div class="card order_table mb-3">
                        <div class="card-header d-flex justify-content-between align-content-center">
                            <div class="align-content-center">
                                <strong class="text-success">Invoice No: #{{ $order->order_number }}</strong>
                                <br>
                                <span>Placed On: {{ date('d M Y, h:i:s A', strtotime($order->created_at)) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('frontend.order.details', $order->order_number) }}"
                                    class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class='table mb-0'>
                                @if (is_seller())
                                    @foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $item)
                                        <tr class="{{ $loop->last ? '' : 'border_bottom' }}">
                                            <td>
                                                <img src="{{ asset($item->ad->thumbnail ?? 'front/no-image.png') }}"
                                                    class="img-fluid" alt="{{ $item->ad->title ?? '' }}">
                                            </td>
                                            <td class="content">
                                                <h4>{{ $item->ad->title ?? '' }}</h4>
                                                <h6>$ {{ $item->total_price }}</h6>

                                            </td>
                                            <td>x{{ $item->quantity }}</td>
                                            <td class="content">
                                                @if ($item->attributes != null)
                                                    @foreach (json_decode($item->attributes, true) as $key => $value)
                                                        {{ $key }} :
                                                        @foreach ($value as $val)
                                                            {{ $val['name'] }} {{ $loop->last ? '' : ',' }}
                                                        @endforeach
                                                        <br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <div class="order_status text-end">
                                                    <h3>{{ ucfirst($item->status) }}</h3>
                                                    <a
                                                        href="{{ route('frontend.order.details', $order->order_number) }}">Track</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($order->orderDetails as $item)
                                        <tr class="{{ $loop->last ? '' : 'border_bottom' }}">
                                            <td width="30%">
                                                <img src="{{ asset($item->ad->thumbnail ?? 'front/no-image.png') }}"
                                                    class="img-fluid" alt="" style="width:200px;height: 150px">
                                            </td>
                                            <td class="content">
                                                <h4>{{ $item->ad->title ?? '' }}</h4>
                                                <h6>$ {{ $item->total_price }}
                                                    <span>
                                                        @if ($item->attributes != null)
                                                            @foreach (json_decode($item->attributes, true) as $key => $value)
                                                                {{ $key }} :
                                                                @foreach ($value as $val)
                                                                    {{ $val['name'] }} {{ $loop->last ? '' : ',' }}
                                                                @endforeach
                                                                {{ $loop->last ? '' : '|' }}
                                                            @endforeach
                                                        @endif
                                                    </span>
                                                </h6>

                                            </td>
                                            <td>
                                                <div class="order_status text-end">
                                                    <h3>{{ ucfirst($item->status) }}</h3>
                                                    <a
                                                        href="{{ route('frontend.order.details', $order->order_number) }}">Track</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <h2 class="text-center">You have no order</h2>
            @endif

            <div class="text-center order_pagination">
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
    <!-- ============================== order list ================================== -->
@endsection
@push('css')
    <style>
        .order-style {
            width: 100%;
            padding: 18px 10px;
            background: gainsboro;
            padding-top: 15px;
            margin-top: 23px;
            margin-bottom: 0px;
            border: 1px solid #e1d4d4;
        }
        .order_pagination .pagination{
            justify-content: center;
        }
    </style>
@endpush
