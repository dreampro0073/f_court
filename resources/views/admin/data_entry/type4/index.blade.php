@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="type4Ctrl">

    @include('admin.data_entry.menu')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Drafting</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type4/add')}}" class="btn btn-primary">Add</a>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Name</th>
                            
                            <th>Draft Type</th>
                            <th>Through Type</th>
                            <th>Bill Type</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drafting as $key => $data)
                        <tr class="<?php echo App\Models\User::bgClass($data->status); ?>">
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{ $data->draft_type}}</td>
                            <td>{{ $data->through_type}}</td>
                            <td>{{ $data->bill_type}}</td>
                            <td>{{ $data->show_status}}</td>
                            <td>
                               <a href="{{url('admin/data-entry/type4/add/'.$data->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                               <a href="{{url('admin/data-entry/type4/delete/'.$data->id)}}" onclick="return confirm('Are you sure to Delete?');" class="btn btn-danger btn-sm">Delete</a> 
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/type4_ctrl.js?v='.$version)}}" ></script>

    
@endsection