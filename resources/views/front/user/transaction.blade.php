@extends('front.layouts.master')
@section('title', __('Transaction'))
@section('content')
    <!-- ============================== breadcrumb ================================= -->
    <!-- <div class="breadcrumb mb-5 d-none d-sm-block"> -->
    <div class="breadcrumb mb-4">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Transaction ({{ is_seller() ? 'Seller' : 'Buyer' }}) </h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================= -->

    <!-- ============================== transaction ================================== -->
    <div class="transaction-sec">
        <div class="container">
            <div class="transaction-table table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Transaction No</th>
                        <th>Order No</th>
                        <th>Date</th>
                        <th>Amount</th>
                        @if(is_seller())
                            <th>Admin Commission</th>
                            <th>Seller total <br> (with Shipping)</th>
                            <th>Status</th>
                            <th>Receive from Admin</th>
                        @else
                            <th>Shipping Charge</th>
                            <th>Status</th>
                        @endif
                        <th>Download</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transactions as $trans)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trans->transaction_number }}</td>
                            <td>#{{ $trans->order->order_number }}</td>
                            <td>{{ date('d M Y', strtotime($trans->created_at)) }}</td>
                            <td>${{ $trans->amount }}</td>
                            @if(is_seller())
                                <td>${{ $trans->admin_commission ?? 0 }}</td>
                                <td>${{ $trans->seller_total ?? $trans->amount + $trans->shipping_charge }}</td>
                                <td>
                                    @if ($trans->payment_status == 1)
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-danger">Unpaid</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($trans->is_paid_to_seller == 1)
                                        <span class="badge bg-primary">Paid</span>
                                    @else
                                        <span class="badge bg-danger">Due</span>
                                    @endif
                                </td>
                            @else
                                <td>{{ $trans->order->shipping_charge }}</td>
                                <td>
                                    @if ($trans->payment_status == 1)
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-danger">Unpaid</span>
                                    @endif
                                </td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('frontend.order.invoice', $trans->order->order_number) }}"
                                   class="btn btn-xs btn-primary"><i class="las la-file-download"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @if($transactions->hasPages())

                        <tr class="text-end">
                            <td colspan="10">
                                <div class="trans_pagination">
                                    {!! $transactions->links() !!}
                                </div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ============================== transaction ================================== -->

@endsection
@push('css')
    <style>
        .trans_pagination .pagination{
            justify-content: end;
        }
    </style>
@endpush
