@extends('admin.settings.setting-layout')
@section('title')
    {{ __('Slider') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">

                <h3 class="card-title" style="line-height: 36px;">{{ __('Slider') }}</h3>
            </div>
            <a href="{{ route('slider.create') }}"
                class="btn btn-primary d-inline-flex align-items-center justify-content-center">
                <i class="fas fa-plus mr-2"></i>
                <span>{{ __('Add Slider') }}</span>
            </a>
        </div>
        <div class="card-body">

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        {{-- <th>Seller</th> --}}
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ getPhoto($slider->path) }}" alt="" class="rounded" width="60px"
                                    height="60"></td>
                            <td>{{ $slider->content_title }}</td>
                            <td>{{ Str::limit($slider->content_body, 40, '...') }}</td>
                            {{-- <td>{{ $slider->user->username ?? '' }}</td> --}}
                            <td>
                                <div>
                                    <label class="switch ">
                                        <input name="my-checkbox" type="checkbox" class="success"
                                            onchange="statusChange({{ $slider->id }})"
                                            {{ $slider->status == 1 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('slider.edit', ['slider' => $slider->id]) }}"><i
                                        class="fa fa-edit"></i></a>
                                <a href="{{ route('slider.destroy', $slider->id) }}" class="btn btn-danger"
                                    onclick="event.preventDefault();document.getElementById('delete-form-{{ $slider->id }}').submit();">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <form id="delete-form-{{ $slider->id }}"
                                    action="{{ route('slider.destroy', ['slider' => $slider->id]) }}" method="post">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-switch/css/bootstrap4/bootstrap-switch.css') }}">
@endsection



@section('script')
    <script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $("[name='my-checkbox']").bootstrapSwitch({
            onColor: "success"
        });
    </script>

    <script>
        function statusChange(id) {

            $.ajax({

                type: "GET",
                dataType: "json",
                url: "{{ route('slider.update.status') }}",
                data: {
                    'id': id
                },
                success: function(response) {
                    console.log(response);
                    toastr.success(response.message, 'Success');
                },

                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
