@extends('admin.department.department-layout')

@section('title')
    {{ __('Department') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">

                <h3 class="card-title" style="line-height: 36px;">{{ __('Department') }}</h3>
            </div>
            {{-- @if (userCan('size.create')) --}}
               {{-- <a href="{{ route('department.create') }}"
                   class="btn btn-primary d-inline-flex align-items-center justify-content-center">
                   <i class="fas fa-plus mr-2"></i>
                  <span>{{ __('Add Department') }}</span>
              </a> --}}
             {{-- @endif --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Name</th>
                        <th width="10%">Created</th>
                        <th width="10%">Status</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $department->name }}</td>
                            <td>{{ date('d M Y', strtotime($department->created_at)) }}</td>
                            </td>
                            <td>
                                @if($department->status == 1)
                                <span class="badge bg-success">Active</span>
                                 @else
                                 <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                {{-- @if (userCan('department.update') || userCan('department.delete')) --}}
                                    <div class="d-flex">
                                        @if (userCan('department.edit'))
                                            <a class="btn btn-primary mr-2"
                                                href="{{ route('department.edit', $department->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                        @endif
                                        {{-- @if (userCan('department.delete')) --}}
{{--                                            <form class="ms-1"--}}
{{--                                                action="{{ route('department.delete', $department->id) }}" method="POST">--}}
{{--                                                @method('DELETE')--}}
{{--                                                @csrf--}}
{{--                                                <button type="submit" class="btn btn-danger"><i--}}
{{--                                                        class="fas fa-trash"></i></button>--}}
{{--                                            </form>--}}
                                        {{-- @endif --}}
                                    </div>
                                {{-- @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $departments->links() }}
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

@endsection
