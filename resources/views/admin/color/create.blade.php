@extends('admin.color.color-layout')
@section('title')
    {{ __('color') }}
@endsection

@section('website-color')
    <div class="card">
         <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                   <h3 class="card-title" style="line-height: 36px;">{{ __('Color') }}</h3>
                    <a href="{{ route('color.index') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i class="fas fa-arrow-left"></i>&nbsp; Back</a>
                </div>
            </div>
        <div class="card-body">


        <form action="{{route('color.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <x-forms.label name="Color" required="true" />
                    <input type="text" name="color" id="color"
                        class="form-control @error('color') border-danger @enderror">
                    @error('color')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 md-3">
                    <div class="d-flex">
                        <button class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </form>


        </div>
    </div>


@endsection
@section('script')
@endsection
