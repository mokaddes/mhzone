@extends('admin.contact.contact-layout')


@section('title')
    {{ __('Contact Subject') }}
@endsection

@section('contact-help')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">

                <h3 class="card-title" style="line-height: 36px;">{{ __('color') }}</h3>
            </div>
            <a href="{{ route('color.create') }}"
                class="btn btn-primary d-inline-flex align-items-center justify-content-center">
                <i class="fas fa-plus mr-2"></i>
                <span>{{ __('Contact Subject') }}</span>
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{-- {{$colors->links()}} --}}
            </div>
        </div>
    </div>
@endsection
