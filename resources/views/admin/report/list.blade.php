@extends('admin.layouts.app')
@section('title')
    {{ __('Seller Report') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('Seller Report') }}</h3>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('Report to') }}</th>
                                    <th>{{ __('Report from') }}</th>
                                    <th>{{ __('Reason') }}</th>
                                    <th>{{ __('Note') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reports as $report)
                                    <tr>
                                        <td width="20%">
                                            @isset($report->reportTo->username)
                                                <a
                                                    href="{{ route('module.customer.show', $report->reportTo->username) }}">{{ $report->reportTo->name }}</a>
                                            @endisset
                                        </td>
                                        <td width="20%">
                                            @isset($report->reportTo->username)
                                                <a
                                                    href="{{ route('module.customer.show', $report->reportTo->username) }}">{{ $report->reportFrom->name }}</a>
                                            @endisset
                                        </td>
                                        <td>{{ $report->reason }}</td>
                                        <td>{{ Str::limit($report->commends, 50) }}</td>
                                        <td>
                                            @if (userCan('report.index') || userCan('report.view'))
                                                <a href="{{ route('report.view', $report->id) }}"
                                                    class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <x-not-found2 />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
