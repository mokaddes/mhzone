@extends('admin.coupon.coupon-layout')
@section('title')
    {{ __('Coupon Edit') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title" style="line-height: 36px;">{{ __('Coupon') }}</h3>
                <a href="{{ route('coupons.index') }}"
                   class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                        class="fas fa-arrow-left"></i>&nbsp; Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-forms.label name="Coupon Name" required="true"/>
                            <input type="text" name="name" id="name" value="{{ $coupon->name }}"
                                   class="form-control @error('name') border-danger @enderror">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <x-forms.label name="Code" required="true"/>
                            <input type="text" name="code" id="name" value="{{ $coupon->code }}"
                                   class="form-control @error('code') border-danger @enderror">
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <x-forms.label name="Coupon Type" required="true"/>
                            <select name="coupon_type" id="coupon_type"
                                    class="form-control @error('coupon_type') border-danger @enderror">
                                <option value="1" {{ $coupon->coupon_type == "1"? "selected" : "" }}>Amount</option>
                                <option value="0" {{ $coupon->coupon_type == "0"? "selected" : "" }}>Percent</option>
                            </select>
                            @error('coupon_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <x-forms.label name="Discount" required="true"/>
                            <input type="text" name="discount" id="discount" value="{{ $coupon->discount }}"
                                   class="form-control @error('discount') border-danger @enderror">
                            @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <x-forms.label name="Valid till" required="true"/>
                            <input type="text" name="valid_till" id="datepicker" value="{{ date('d M Y', strtotime($coupon->valid_till)) }}"
                                   class="form-control datepicker @error('valid_till') border-danger @enderror">
                            @error('valid_till')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <x-forms.label name="Status" required="true"/>
                            <select name="status" id="status"
                                    class="form-control @error('status') border-danger @enderror">
                                <option value="1" {{ $coupon->status == "1"? "selected" : "" }}>Active</option>
                                <option value="0" {{ $coupon->status == "0"? "selected" : "" }}>Inactive</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="col-md-12 md-3">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection




@section('script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd-mm-yy",
                // maxDate: 'today'
                minDate: 0
            });
        } );
    </script>
@endsection
