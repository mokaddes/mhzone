@extends('admin.department.department-layout')
@section('title')
    {{ __('Department Edit') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title" style="line-height: 36px;">{{ __('Department') }}</h3>
                <a href="{{ route('department.index') }}"
                    class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                        class="fas fa-arrow-left"></i>&nbsp; Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('department.update',$department->id) }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <x-forms.label name="Department Name" required="true" />
                        <input type="text" name="name" id="name" value="{{ $department->name }}"
                            class="form-control @error('name') border-danger @enderror">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <x-forms.label name="Status" required="true" />
                        <select name="status" id="status" class="form-control @error('status') border-danger @enderror">
                            <option value="1" {{ $department->status == 1? "selected" : "" }}>Active</option>
                            <option value="0" {{ $department->status == 0? "selected" : "" }}>Inactive</option>
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
    {{-- category-subcategory dropdown --}}
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>

@endsection
