@extends('admin.withdraw_request.withdraw')


@section('title')
    {{ __('Withdraw Edit') }}
@endsection

@section('withdraw')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h3 class="card-title" style="line-height: 36px;">{{ __('Withdraw Edit') }}</h3>
            </div>

        </div>
        <div class="card-body">
            <form action="{{route('admin.withdrawRequest.update',['withdrawRequest'=>$withdrawRequest->id])}}" enctype="multipart/form-data" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paymentBy">Patment By</label>
                            <input type="text" name="payment_by" id="paymentBy" class="form-control" required value="{{$withdrawRequest->payment_by ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label for="paymentBy">Patment By</label>
                            <select name="status" id="status" class="form-control" required>
                                <option  value="">Select Status</option>
                                <option {{!$withdrawRequest->status ? "selected" : '' }} value="0">Pending</option>
                                <option {{$withdrawRequest->status ? "selected" : '' }} value="1">Aproved</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-forms.label name="Slider Image" />
                            <div class="row">
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{asset($withdrawRequest->screenshoot) ?? $cms->home_main_banner }}" name="image"
                                    autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                                    accept="image/png, image/jpg, image/jpeg" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
@endsection
@section('script')
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection
