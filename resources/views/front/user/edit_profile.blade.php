@extends('front.layouts.master')

@section('title', __('Edit profile'))

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        .file_input {
            padding: 21px 13px !important;
        }

        #image-preview {
            width: 150px;
            height: 150px;
            margin-bottom: 23px !important;
        }
    </style>
@endpush

@section('content')
    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-5 d-none d-sm-block">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="breadcrumb_name">
                    <h3>Edit Profile</h3>
                </div>
                <div class="breadcrumb_name">
                    <h3>mhzone</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->
    <!-- ============================== Edit profile ================================== -->
    <div class="edit_profile">
        <div class="container">
            <div class="login_form signup text-center">
                {{-- <div class="pt-4 pt-sm-0 d-block d-sm-none">
                    <h4>Welcome to</h4>
                    <h2>mhzone</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur. Lobortis posuere egestas vitae placerat lorem
                        elementum
                    </p>
                </div> --}}
                <img id="image-preview" src="{{ asset(Auth::user()->image ?? 'front/assets/images/profile.png') }}" class="img-fluid mb-2" alt="image">
                <h3>Edit Profile </h3>
                <div class="row d-flex justify-content-center custome_input_field mb-5">
                    <div class="col-lg-6">
                        <form action="{{ route('frontend.user.profile.update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-file"></i></span>
                                    <input type="file" name="image" id="image"
                                        accept="image/png, image/jpeg, image/jpg" class="form-control file_input">
                                    <span class="d-block d-sm-none mt-4 d-block text-sm">
                                        "mhzone" Would Like to Access Your Photos. (To choose user profile image)
                                    </span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-user"></i></span>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}" id="name"
                                        class="form-control" placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-envelope"></i></span>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" id="email"
                                        class="form-control" placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-mobile"></i></span>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" id="phone"
                                        class="form-control" placeholder="Mobile Number" required>
                                </div>
                            </div>
                            {{-- <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="las la-calendar"></i></span>
                                    <input type="text" name="dob" id="date"
                                        value="{{ isset(Auth::user()->dob) ? date('d-m-Y', strtotime(Auth::user()->dob)) : '' }}"
                                        class="form-control datepicker" placeholder="Date of Birth" readonly>
                                </div>
                            </div> --}}
                            <div class="mb-4">
                                <label for="change_password">
                                    <strong class="d-inline">Change Password</strong>
                                </label>
                                <input type="checkbox" name="change_password" class="change_password" id="change_password" value="1">
                            </div>
                            <div class="password_section" style="display: none">
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="la la-lock"></i>
                                        </span>
                                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="la la-lock"></i>
                                        </span>
                                        <input type="password" name="password" id="new_password" class="form-control" placeholder="New password">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="la la-lock"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteAccount">
                            <span class="icon--left">
                                <x-svg.delete-icon />
                            </span>
                            {{ __('Delete account') }}
                        </button>
                    </div>
                </div>
                <div class="modal fade" id="deleteAccount" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Delete account
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('frontend.user.account.delete', auth()->id()) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">
                                                To confirm, type "delete" in the box below
                                            </label>
                                            <input type="text" name="del_acc" id="del_acc" class="form-control" autocomplete="off"
                                                required>
                                            @error('del_acc')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button type="submit" class="btn btn-danger" id="deleteBtn" disabled>
                                                <span class="icon--left">
                                                    <x-svg.delete-icon />
                                                </span>
                                                Delete
                                            </button>
                                        </div>
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

@push('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd-mm-yy",
                maxDate: 'today'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Listen for changes to the file input
            $('.file_input').on('change', function(event) {
                // Get the selected file
                var file = event.target.files[0];

                // Create a new FileReader instance
                var reader = new FileReader();

                // Listen for the FileReader to load the file
                reader.onload = function(event) {
                    // Set the src attribute of the image preview to the data URL of the loaded image
                    $('#image-preview').attr('src', event.target.result);
                }

                // Read the selected file as a data URL
                reader.readAsDataURL(file);
            });

            $('.change_password').on('change', function(event) {
                if ($(this).is(':checked')) {
                    $('.password_section').show();
                } else {
                    $('.password_section').hide();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#del_acc').on('wheel keyup change', function(event) {
                var delacc = $("#del_acc").val();
                if(delacc === "delete") {
                    $("#deleteBtn").removeAttr('disabled', '');
                }else {
                    $("#deleteBtn").attr('disabled','disabled');
                }
            });
        });
    </script>
@endpush
