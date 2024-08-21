@extends('admin.order.order-layout')

@section('title')
    {{ __('All Order') }}
@endsection

@section('website-orders')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h3 class="card-title" style="line-height: 36px;">{{ __('Orders') }}</h3>
            </div>
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Order No</th>
                        <th>Subtotal</th>
                        <th>Shipping Charge</th>
                        <th>Total amount</th>
                        <th>Admin Commission</th>
                        <th>Order Date</th>
                        {{-- <th>Order Status</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>${{ $order->subtotal }}</td>
                            <td>${{ $order->shipping_charge }}</td>
                            <td>${{ $order->total_price }}</td>
                            <td>${{ $order->transactionDetails->sum('admin_commission') }} ({{ $order->admin_commission_percent }})</td>
                            <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                            {{-- <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($order->status == 'processing')
                                <span class="badge bg-info">Processing</span>
                                @elseif($order->status == 'shipped')
                                <span class="badge bg-primary">Shipped</span>
                                @elseif($order->status == 'delivere')
                                <span class="badge bg-success">delivere</span>
                                @endif
                            </td> --}}
                            <td>
                                @if (userCan('admin.orders.details'))
                                <a href="{{route('admin.orders.details',$order->order_number)}}" class="btn btn-info btn-sm">View</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <td class="8">No Order</td>
                    @endforelse
                </tbody>
               
            </table>
            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection
