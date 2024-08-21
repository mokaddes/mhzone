@extends('admin.coupon.coupon-layout')

@section('title')
    {{ __('Coupon') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">

                <h3 class="card-title" style="line-height: 36px;">{{ __('Coupon') }}</h3>
            </div>
            
               <a href="{{ route('coupons.create') }}"
                   class="btn btn-primary d-inline-flex align-items-center justify-content-center">
                   <i class="fas fa-plus mr-2"></i>                  
                   <span>{{ __('Add Coupon') }}</span>       
                 </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Name</th>
                        <th width="10%">Code</th>
                        <th width="10%">Type</th>
                        <th width="10%">Discount</th>
                        <th width="10%">Valid Till</th>
                        <th width="10%">Status</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->code }}</td>
                            <td>
                                @if($data->coupon_type == 1)
                                <span class="badge bg-success">Amout</span>
                                 @else
                                 <span class="badge bg-info">Percent</span>
                                @endif
                            </td>
                            <td>{{ $data->discount }}</td>
                            <td>{{ date('d M Y', strtotime($data->valid_till)) }}</td>
                            <td>
                                @if($data->status == 1)
                                <span class="badge bg-success">Acitve</span>
                                 @else
                                 <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                {{-- @if (userCan('department.update') || userCan('department.delete')) --}}
                                    <div class="d-flex">
                                        {{-- @if (userCan('size.update')) --}}
                                            <a class="btn btn-primary mr-2"
                                                href="{{ route('coupons.edit', $data->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                        {{-- @endif --}}
                                        {{-- @if (userCan('department.delete')) --}}
                                           <form class="ms-1"
                                              action="{{ route('coupons.delete', $data->id) }}" method="POST">
                                              @method('DELETE')   @csrf
                                              <button type="submit" class="btn btn-danger"><i
                                                      class="fas fa-trash"></i></button>
                                          </form>
                                        {{-- @endif --}}
                                    </div>
                                {{-- @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $coupons->links() }}
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
