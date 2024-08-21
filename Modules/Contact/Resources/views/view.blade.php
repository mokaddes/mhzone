@extends('admin.layouts.app')
@section('title')
    {{ __('contact Details') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('contact Details') }}</h3>
                        <a href="{{ route('module.contact.index') }}" class="float-right btn btn-info">Back</a>

                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                         
                            <tr>
                                <td width:10%>Name</td>
                                <td>{{ $contact->name }}</td>
                    
                            </tr>
                            <tr>
                                <td >Email</td>
                                <td>{{ $contact->email }}</td>
                    
                            </tr>
                            <tr>
                                <td >Subject</td>
                                <td>{{ $contact->subject }}</td>
                    
                            </tr>
                            <tr>
                                <td >Message</td>
                                <td>{{ $contact->message }}</td>
                    
                            </tr>
                            <tr>
                                <td >Date</td>
                                <td>{{ date('d M Y', strtotime($contact->created_at)) }}</td>
                    
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection



