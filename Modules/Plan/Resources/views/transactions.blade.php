@extends('admin.layouts.app')

@section('title')
    {{ __('transaction history') }}
@endsection

@section('content')
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
                                    <th>{{ __('Customer') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    {{-- <th>{{ __('coupons') }}</th> --}}
                                    <th>{{ __('Payment Provider') }}</th>
                                    <th>{{ __('Created Time') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $transaction->order_id }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $transaction->transaction_id ?? '--' }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('module.customer.show', $transaction->customer->username) }}">{{ $transaction->customer->name }}</a>
                                        </td>
                                        <td class="text-muted">
                                            {{ $transaction->currency_symbol }}{{ $transaction->amount }}
                                        {{-- <td class="text-muted">
                                                {{ $transaction->coupons }}
                                        </td> --}}
                                        <td class="text-muted">{{ ucfirst($transaction->payment_provider) }}</td>
                                        <td class="text-muted">
                                            {{ date('M d, Y', strtotime($transaction->created_at)) }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
