@extends('admin.color.color-layout')

@section('title')
    {{ __('Colors') }}
@endsection

@section('website-color')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h3 class="card-title" style="line-height: 36px;">{{ __('color') }}</h3>
            </div>
            @if (userCan('color.create'))
                <a href="{{ route('color.create') }}"
                    class="btn btn-primary d-inline-flex align-items-center justify-content-center">
                    <i class="fas fa-plus mr-2"></i>
                    <span>{{ __('Add color') }}</span>
                </a>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Color</th>
                        <th width="15%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $color->color }}</td>
                            <td>
                                <label class="switch ">
                                    <input id="check{{ $color->id }}" name="my-checkbox" type="checkbox"
                                        onchange="toggle({{ $color->id }})" class="success toggle-switch"
                                        {{ $color->status == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                @if (userCan('color.update') || userCan('color.destroy'))
                                    <div class="d-flex">
                                        @if (userCan('color.update'))
                                            <a class="btn btn-primary mr-2" href="{{ route('color.edit', ['color' => $color->id]) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        @if (userCan('color.destroy'))
                                            <form action="{{ route('color.destroy', ['color' => $color->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $colors->links() }}
            </div>
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
        function toggle(id) {
            var status = 0;

            if ($('#check' + id).is(':checked')) {
                status = 1;
            } else {
                status = 0;
            }
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('color.status.change') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': status,
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
