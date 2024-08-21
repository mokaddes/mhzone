@extends('admin.size.size-layout')

@section('title')
    {{ __('Size') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">

                <h3 class="card-title" style="line-height: 36px;">{{ __('Size') }}</h3>
            </div>
            @if (userCan('size.create'))
                <a href="{{ route('size.create') }}"
                    class="btn btn-primary d-inline-flex align-items-center justify-content-center">
                    <i class="fas fa-plus mr-2"></i>
                    <span>{{ __('Add Size') }}</span>
                </a>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Size</th>
                        <th width="10%">Categorys</th>
                        <th width="10%">Status</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adSizes as $size)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $size->size }}</td>
                            <td>{{ isset($size->category->name) ? $size->category->name . ',' : '' }}{{ isset($size->subCategory->name) ? $size->subCategory->name . ',' : '' }}
                            </td>
                            <td>
                                <input name="my-checkbox" id="check{{ $size->id }}"
                                    onchange="toggle({{ $size->id }})" class="toggle-class" type="checkbox"
                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On"
                                    data-off="Off" {{ $size->status ? 'checked' : '' }}>
                            </td>
                            <td>
                                @if (userCan('size.update') || userCan('size.destroy'))
                                    <div class="d-flex">
                                        @if (userCan('size.update'))
                                            <a class="btn btn-primary mr-2"
                                                href="{{ route('size.edit', ['size' => $size->id]) }}"><i
                                                    class="fas fa-edit"></i></a>
                                        @endif
                                        @if (userCan('size.destroy'))
                                            <form class="ms-1"
                                                action="{{ route('size.destroy', ['size' => $size->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button>
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
                {{ $adSizes->links() }}
            </div>

        </div>
    </div>
@endsection


@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-switch/css/bootstrap4/bootstrap-switch.css') }}">
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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


            console.dir({
                id,
                status
            });
            $.ajax({
                type: "POST",
                url: "{{ route('size.status.change') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    toastr.success(data.message, 'Success');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
