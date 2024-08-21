@extends('admin.layouts.app')

@section('title')
    {{ __('customer list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Customer list') }}</h3>
                        @if (userCan('module.customer.create'))
                        <a href="{{ route('module.customer.create') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-plus"></i>&nbsp; {{ __('Add Customer') }}</a>
                        @endif        
                    </div>
                    <div class="card-body table-responsive p-0">
                        <form action="{{ route('module.customer.index') }}" method="GET">
                            <div class="row justify-content-between my-3">
                                <div class="col-sm-12 col-md-6 ml-2">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <select name="perpage" class="form-control form-control-sm">
                                                <option {{ request('perpage') == '10' ? 'selected' : '' }} value="10">
                                                    10
                                                </option>
                                                <option {{ request('perpage') == '25' ? 'selected' : '' }} value="25">
                                                    25
                                                </option>
                                                <option {{ request('perpage') == '50' ? 'selected' : '' }} value="50">
                                                    50
                                                </option>
                                                <option {{ request('perpage') == '100' ? 'selected' : '' }} value="100">
                                                    100
                                                </option>
                                                <option {{ request('perpage') == 'all' ? 'selected' : '' }} value="all">
                                                    All
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="sort_by" class="form-control form-control-sm">
                                                <option value="" class="d-none">{{ __('Sort By') }}</option>
                                                <option {{ request('sort_by') == 'latest' ? 'selected' : '' }}
                                                    value="latest">
                                                    {{ __('Latest') }}
                                                </option>
                                                <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }}
                                                    value="oldest">
                                                    {{ __('Oldest') }}
                                                </option>
                                            </select>
                                        </div>
                                        {{-- <div class="col-sm-3">
                                            <select name="filter_by" class="form-control form-control-sm">
                                                <option value="" class="d-none">{{ __('Filter by') }}</option>
                                                <option {{ request('filter_by') == 'verified' ? 'selected' : '' }}
                                                    value="verified">
                                                    {{ __('Verified User') }}</option>
                                                <option {{ request('filter_by') == 'unverified' ? 'selected' : '' }}
                                                    value="unverified">
                                                    {{ __('Unverified User') }}</option>
                                                <option {{ request('filter_by') == 'most_viewed' ? 'selected' : '' }}
                                                    value="most_viewed">{{ __('Most Viewed') }}</option>
                                            </select>
                                        </div> --}}
                                        <div class="col-sm-3">
                                            <select name="filter_by" class="form-control form-control-sm">
                                                <option value="" class="d-none">{{ __('Filter by') }}</option>
                                                <option {{ request('filter_by') == 'all' ? 'selected' : '' }}
                                                    value="all">
                                                    {{ __('All') }}</option>
                                                <option {{ request('filter_by') == 'seller' ? 'selected' : '' }}
                                                    value="seller">
                                                    {{ __('Seller') }}</option>
                                                <option {{ request('filter_by') == 'buyer' ? 'selected' : '' }}
                                                    value="buyer">{{ __('Buyer') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-primary btn-sm"
                                                type="submit">{{ __('Filter') }}</button>
                                            @if (request('keyword') || request('filter_by') || request('sort_by') || request('perpage'))
                                                <a href="{{ route('module.customer.index') }}"
                                                    class="btn btn-danger btn-sm" type="submit">{{ __('Clear') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 text-right mr-2">
                                    <input type="text" value="{{ request('keyword') }}" class="form-control"
                                        placeholder="{{ __('search') }}..." name="keyword"
                                        aria-label="{{ __('search') }}">
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="2%">#</th>
                                            <th width="5%">{{ __('Image') }}</th>
                                            <th width="10%">{{ __('Name') }}</th>
                                            <th width="10%">{{ __('Email') }}</th>
                                            <th width="10%">{{ __('Username') }}</th>
                                            {{-- <th width="10%">{{ __('Purchase plan') }}</th> --}}
                                            {{-- <th width="10%">{{ __('coupons') }}</th> --}}
                                            <th width="10%">{{ __('Verified email') }}</th>
                                            <th width="10%">{{ __('Speciality') }}</th>
                                            <th width="5%">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customers as $key =>$customer)
                                            <tr>
                                                <td class="text-center" tabindex="0">{{ $key + 1 }}
                                                </td>
                                                <td class="text-center" tabindex="0">
                                                    <img src="{{ $customer->image_url }}" class="rounded" height="50px"
                                                        width="50px" alt="image">
                                                </td>
                                                <td class="text-center" tabindex="0">{{ $customer->name }}</td>
                                                <td class="text-center" tabindex="0">{{ $customer->email }}</td>
                                                <td class="text-center" tabindex="0">{{ $customer->username }}</td>
                                                {{-- <td class="text-center" tabindex="0">
                                                    {{ $customer->transactions_count }}
                                                    {{ __('times') }}</td> --}}
                                                {{-- <td class="text-center" tabindex="0">{{ $customer->coupons ?? 0 }}</td> --}}
                                                <td class="text-center">
                                                    <span
                                                        class="badge badge-{{ $customer->email_verified_at ? 'success' : 'warning' }}">
                                                        {{ $customer->email_verified_at ? 'Verified' : 'Unverified' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $customer->quick_responder ? 'success' : 'warning' }}">
                                                        {{ $customer->quick_responder ? 'Quick Responder' : 'Not Quick Responder' }}
                                                    </span>
                                                    <span
                                                        class="badge badge-{{ $customer->trusted_seller ? 'success' : 'warning' }}">
                                                        {{ $customer->trusted_seller ? 'Trusted Seller' : 'Not Trusted Seller' }}
                                                    </span>
                                                </td>
                                                @if (userCan('module.customer.edit'))
                                                <td class="text-center" tabindex="0">
                                                    <button type="button" class="btn btn-info dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        {{ __('Options') }}
                                                    </button>
                                                    <ul class="dropdown-menu" x-placement="bottom-start"
                                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('module.customer.show', $customer->username) }}">
                                                                <i class="fas fa-eye text-info"></i>
                                                                {{ __('View Details') }}
                                                            </a></li>

                                                        <li><a class="dropdown-item"
                                                                href="{{ route('module.customer.edit', $customer->username) }}">
                                                                <i class="fas fa-edit text-success"></i>
                                                                {{ __('Edit Customer') }}
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('module.customer.ads', $customer->username) }}">
                                                                <i class="fab fa-adversal text-primary"></i></i>
                                                                {{ __('View Customer Ads') }}
                                                            </a></li>
                                                        <li>
                                                            {{-- <form
                                                                action="{{ route('module.customer.destroy', $customer->username) }}"
                                                                method="POST" class="d-inline">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('{{ __('are you sure want to delete this item') }}');">
                                                                    <i class="fas fa-trash text-danger"></i>
                                                                    {{ __('delete customer') }}
                                                                </button>
                                                            </form> --}}
                                                        </li>
                                                    </ul>
                                                </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    <x-not-found word="{{ __('User') }}"
                                                        route="module.customer.create" />
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (request('perpage') != 'all' && $customers->total() > $customers->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $customers->links() }}
                            </div>
                        </div>
                    @endif
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

        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection



@section('script')
    <script>
        $('form#register').find('input').each(function() {
            if (!$(this).prop('required')) {
                console.log("NR");
            } else {
                console.log("IR");
            }
        });
    </script>
    <script>
        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var username = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route('module.customer.emailverified') }}',
                data: {
                    'status': status,
                    'username': username
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        })
    </script>
@endsection
