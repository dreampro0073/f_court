@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main">

    @include('admin.data_entry.menu')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Agricultural Finance</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type3/add')}}" class="btn btn-primary">Add</a>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Year</th>
                            <th>Finance Type</th>
                            <th>Bank Name</th>
                            <th>Through</th>
                            <th>Borrower Name</th>
                            <th>Billing Type</th>
                            <th>Contact No</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agricultural_finance as $key => $data)
                        <tr class="<?php echo App\Models\User::bgClass($data->status); ?>">
                            <td>{{$key+1}}</td>
                            <td>{{$data->ys_name}}</td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->bank_name}}</td>
                            <td>{{$data->through_type}}</td>
                            <td>{{$data->borrower_name}}</td>
                            <td>{{$data->bill_type}}</td>
                            <td>{{$data->contact_no}}</td>
                            <td>
                                <a href="{{url('admin/data-entry/type3/add/'.$data->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                                <a href="{{url('admin/data-entry/type3/delete/'.$data->id)}}" onclick="return confirm('Are you sure to Delete?');" class="btn btn-danger btn-sm">Delete</a> 
                            </td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
</div>
@endsection

@section('footer_scripts')
    
    
@endsection