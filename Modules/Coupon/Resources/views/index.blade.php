@extends('admin.layouts.app')

@section('title')
    {{ __('Coupon List') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Coupon List') }}</h3>
                        @if (userCan('module.coupon.create'))
                            <a href="{{ route('module.coupon.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus"></i>&nbsp; {{ __('Add Coupon') }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }} </th>
                                    <th>{{ __('Coupons') }} </th>
                                    <th>{{ __('Price (Euro)') }} </th>
                                    <th>{{ __('Status') }} </th>
                                    <th width="10%">{{ __('actions') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $coupon->name }}
                                        </td>
                                        <td>{{ $coupon->coupons }}</td>
                                        <td>{{ $coupon->price }}</td>
                                        <td>
                                            @if ($coupon->status == 0)
                                                <span class="badge bg-danger">Inactive</span>
                                            @else
                                                <span class="badge bg-success">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (userCan('module.coupon.edit') || userCan('module.coupon.destroy'))
                                                @if (userCan('module.coupon.edit'))
                                                    <a title="{{ __('Edit Coupon') }} "
                                                        href="{{ route('module.coupon.edit', $coupon->id) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('module.coupon.destroy'))
                                                    <form action="{{ route('module.coupon.destroy', $coupon->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('Delete Coupon') }} "
                                                            onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="coupon" route="module.coupon.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
                        <div class="d-flex justify-content-center">
                            {{ $coupons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .page-link.page-navigation__link.active {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
    </style>
@endsection
