@extends('admin.layouts.app')

@section('title')
    {{ __('transaction history') }}
@endsection

@section('content')
<div class="row mb-2 mt-4">
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Transaction') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Transaction') }}</li>
        </ol>
    </div>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('transaction history') }}</h3>
                        <a href="{{ url()->previous() }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Order ID') }}</th>
                                    <th>{{ __('Transaction ID') }}</th>
                                    <th>{{ __('Buyer') }}</th>
                                    <th>{{ __('Seller') }}</th>
                                    <th>{{ __('Payment Method') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Admin Commission') }}</th>
                                    <th>{{ __('Seller Total (with shipping)') }}</th>
                                    <th>{{ __('Status (Customer)') }}</th>
                                    <th>{{ __('Paid to Seller') }}</th>
                                    <th>{{ __('download') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $transaction->order->order_number }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $transaction->transaction_number ?? '--' }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('module.customer.show', $transaction->buyer->username) }}">{{ $transaction->buyer->name }}</a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('module.customer.show', $transaction->seller->username) }}">{{ $transaction->seller->name }}</a>
                                        </td>
                                        <td class="text-muted">{{ ucfirst($transaction->transaction->payment_provider) }}</td>
                                        <td class="text-muted">
                                            ${{ $transaction->amount }}
                                        </td>
                                        <td class="text-muted">
                                            ${{ $transaction->admin_commission }}
                                        </td>
                                        <td class="text-muted">
                                            ${{ $transaction->seller_total }}
                                        </td>
                                        <td>
                                            @if ($transaction->payment_status == 1)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Unpaid</span>
                                            @endif
                                        <td class="text-center" tabindex="0">
                                            <div class="dropdown show">
                                                <button  type="button" class="dropdown-toggle btn-sm btn btn-{{ $transaction->is_paid_to_seller == 1? "info" : "danger" }}" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ $transaction->is_paid_to_seller  == 1? "Paid" : "Due" }}
                                                </button>
                                                @if(Auth::user()->can('admin.seller.payment'))
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        @if($transaction->is_paid_to_seller  == 0)
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.seller.payment', [$transaction->id , '1']) }}"
                                                               onclick="return confirm('Are you sure to perform this action?')">Paid</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                               href="{{ route('admin.seller.payment', [$transaction->id , '0']) }}"
                                                               onclick="return confirm('Are you sure to perform this action?')">Due</a>
                                                        @endif

                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        </td>
                                        <td class="text-center">
                                            @if (userCan('admin.invoice'))
                                            <a href="{{ route('admin.invoice', $transaction->order->order_number) }}"
                                               class="btn btn-xs btn-primary"><i class="fas fa-file-download" style="font-size: 25px"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <span class="">{{ __('no transactions found') }}...</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
