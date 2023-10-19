@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="type1Ctrl">

    @include('admin.data_entry.menu')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Legal Opinion Data</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type1/add')}}" class="btn btn-primary">Add</a>

            <a href="{{url('admin/data-entry/type1?exportExcel=1')}}" class="btn btn-primary">Export</a>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Bank name</th>
                            <th>Through Type</th>
                            <th>Bill Type</th>
                            <th>Contact Number</th>
                            <th>TAT</th>
                            <th>Satus</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($legal_opinion_data as $key => $data)

                        <tr class="<?php echo App\Models\User::bgClass1($data->status); ?>">
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->bank_name}}</td>
                            <td>{{ $data->through_type}}</td>
                            <td>{{ $data->bill_type}}</td>
                            <td>{{ $data->contact_no}}</td>
                            <td>{{ $data->day}}</td>
                            <td>{{ $data->show_status}}</td>
                            <td>
                               <a href="{{url('admin/data-entry/type1/add/'.$data->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                               <a href="{{url('admin/data-entry/type1/delete/'.$data->id)}}" onclick="return confirm('Are you sure to Delete?');" class="btn btn-danger btn-sm">Delete</a> 
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
    <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/type1_ctrl.js?v='.$version)}}" ></script>

    
@endsection