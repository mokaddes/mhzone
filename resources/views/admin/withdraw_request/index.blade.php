@extends('admin.withdraw_request.withdraw')


@section('title')
    {{ __('Withdraw') }}
@endsection

@section('withdraw')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h3 class="card-title" style="line-height: 36px;">{{ __('Withdraw') }}</h3>
            </div>

        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Seller Name</th>
                        <th>Amount</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th>Aproved Date</th>
                        <th>Payment By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($withdrawRequests as $withdrawRequest)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $withdrawRequest->seller->name }}</td>
                            <td>{{ $withdrawRequest->seller->withdraw_request_amount }}</td>
                            <td>{{ date('d-m-Y', strtotime($withdrawRequest->withdraw_request_date)) }}</td>
                            <td>{{ $withdrawRequest->status ? 'Approved' : 'Pending' }}</td>
                            <td>{{ $withdrawRequest->approved_date }}</td>
                            <td>{{ $withdrawRequest->payment_by ?? '' }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.withdrawRequest.edit', ['withdrawRequest' => $withdrawRequest->id]) }}"><i
                                        class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('style')
@endsection

@section('script')
@endsection
