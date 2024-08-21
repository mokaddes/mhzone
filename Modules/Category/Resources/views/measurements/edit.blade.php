@extends('admin.layouts.app')

@section('title')
    {{ __('Edit Measurement Points') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Edit Measurement Points') }}</h3>
                        <a href="{{ route('module.measurement.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal"
                                action="{{ route('module.measurement.update', $measurement->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-15">
                                    <x-forms.label name="Name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name"
                                            value="{{ str_replace('_', ' ', $measurement->name) }}" class="form-control">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Status" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1" {{ $measurement->status == 1 ? 'active' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $measurement->status == 0 ? 'active' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('update') }}</button>
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

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }



        input[type=checkbox] {
            width: 20px;
            height: 20px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('#status').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
