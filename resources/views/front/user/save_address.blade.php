@extends('front.layouts.master')
@section('title', __('Address'))
@push('css')
    <style>
        input[type="radio"]:checked+.form-check-label {
            background: rgb(217, 217, 217);
        }

        .form-check-label {
            position: relative;
            margin: 0px 1px;
            font-family: 'JetBrains Mono', sans-serif;
            cursor: pointer;
            background: #fff;
            border: 1px solid #d6d6d6;
            border-radius: 12px;
            font-style: normal;
            font-weight: 400;
            letter-spacing: .125em;
            font-size: 16px;
            padding: 12px 29px;
            text-align: center;
        }

        .address_form .form-control {
            background: #c8c8c8dd;
            padding: 14px 20px;
            border-radius: 7px;
            color: rgb(0, 0, 0);
            font-size: 15px;
            outline: none;
            border: none;
        }

        .non_width_btn {
            padding: 15px 25px !important;
            font-size: 16px;
        }

        .checked-icon {
            width: 50px;
            height: 50px;
            float: left;
            vertical-align: middle;
            line-height: 55px;
        }

        .checked-icon i {
            font-size: 25px;
            color: var(--bg-green);
            clear: both;
        }

        .address-text {
            font-size: 13px;
        }

        .btn-danger {
            border: none !important;
            font-weight: 500;
            font-size: 16px;
            border-radius: 10px;
            color: #fff !important;
        }

        .text-right {
            text-align: right !important;
        }

        .modal {
            --bs-modal-width: 660px !important;
        }

        .myBtn .btn {
            background: rgb(153, 153, 153);
            text-align: center;
            border: 1px solid rgb(244 244 244) !important;
            border-radius: 50px;
            font-size: 17px;
            color: #fff !important;
            width: 40px;
            height: 40px;
            line-height: 30px;
        }

        .form-group {
            text-align: center;
        }
    </style>
@endpush

@section('content')

    <div class="breadcrumb mb-5 d-none d-sm-block">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Address</h3>
            </div>
        </div>
    </div>

    <div class="saved_address_sec">
        <div class="container">
            <div class="title d-flex align-items-center justify-content-between mb-2">
                <div>
                    <h5 class="m-0">All saved address</h5>
                </div>
                <div>
                    <a herf="javascript:void(0)" id="add_address_btn" style="cursor:pointer;">Create a new address</a>
                </div>

            </div>
            <div class="myBtn">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($shipping_address) && $shipping_address->count() > 0)
                                @foreach ($shipping_address as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            {{ $item->apartment }},
                                            {{ $item->address }},
                                            {{ $item->city }},
                                            {{ $item->state }}-
                                            {{ $item->postcode }}
                                            @if (!empty($item->country))
                                                ,
                                                {{ $item->country }}
                                            @endif
                                        </td>
                                        <td class="text-text-capitalize">{{ ucfirst($item->address_type) }}</td>
                                        <td>
                                            <a class="btn btn-sm edit-address"
                                                href="{{ route('frontend.user.address.edit', $item->id) }}">
                                                <i class="la la-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-sm delete-address"
                                                onclick="return confirm('Are you sure you want to delete this address?')"
                                                href="{{ route('frontend.user.address.delete', $item->id) }}">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <h6 class="text-center">Saved addresses not found</h6>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addressmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addressmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressmodalLabel">Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="addressmodalBody">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).on('click', ".edit-address", function(e) {
            e.preventDefault();
            var route = $(this).attr('href');
            var _this = this;
            $.ajax({
                type: 'get',
                url: route,
                async: true,
                beforeSend: function() {
                    $("body").css("cursor", "progress");
                    $(_this).attr("disabled", true);
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('#addressmodalBody').html(response.data);
                        $('#addressmodal').modal('show');
                    } else {
                        toastr.error(response.message);
                    }
                    $(_this).attr("disabled", false);
                },
                error: function(jqXHR, exception) {
                    toastr.error('Something wrong');
                    $(_this).attr("disabled", false);
                },
                complete: function(response) {
                    $("body").css("cursor", "default");
                }
            });
        });
        $(document).on('submit', "#address_update_form", function(e) {
            e.preventDefault();
            var form = $("#address_update_form");
            var _this = $(this).find(":submit");
            $.ajax({
                type: 'post',
                data: form.serialize(),
                url: form.attr('action'),
                async: true,
                beforeSend: function() {
                    $("body").css("cursor", "progress");
                    $(_this).attr("disabled", true);
                },
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.message);
                        $('#addressmodal').modal('hide');
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                    $(_this).attr("disabled", false);
                },
                error: function(jqXHR, exception) {
                    toastr.error('Something wrong');
                    $(_this).attr("disabled", false);
                },
                complete: function(response) {
                    $("body").css("cursor", "default");
                }
            });
        });

        $(document).on('submit', "#address_create_form", function(e) {
            e.preventDefault();
            var form = $("#address_create_form");
            var _this = $(this).find(":submit");
            $.ajax({
                type: 'post',
                data: form.serialize(),
                url: form.attr('action'),
                async: true,
                beforeSend: function() {
                    $("body").css("cursor", "progress");
                    $(_this).attr("disabled", true);
                },
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.message);
                        $('#addressmodal').modal('hide');
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                    $(_this).attr("disabled", false);
                },
                error: function(jqXHR, exception) {
                    toastr.error('Something wrong');
                    $(_this).attr("disabled", false);
                },
                complete: function(response) {
                    $("body").css("cursor", "default");
                }
            });
        });
        $(document).on('click', '#add_address_btn', function(e) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('frontend.user.address.create') }}',
                success: function(response) {
                    $('#addressmodalBody').html(response.data);
                    $('#addressmodal').modal('show');
                }
            });
        })
    </script>
@endpush
