@extends('admin.layouts.app')
@section('title')
    {{ __('Coupon Edit') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Coupon Edit') }}</h3>
                        <a href="{{ route('module.coupon.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.coupon.update', $coupon->id) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="Package Name" :required="false" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $coupon->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('Enter Coupon Name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Coupons Quantity" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $coupon->coupons }}" name="coupons" type="text"
                                            class="form-control @error('coupons') is-invalid @enderror"
                                            placeholder="{{ __('Enter Coupon Quantity') }}">
                                        @error('coupons')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Price" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $coupon->price }}" name="price" type="text"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="{{ __('Enter Price') }}">
                                        @error('price')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Status" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>&nbsp;{{ __('update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
