@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="notingCtrl">

    @include('admin.data_entry.menu2')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Noting Charge</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/noting-charge/add')}}" class="btn btn-primary">Add</a>
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
                            <th>TAT</th>
                            <th>Status</th>

                            <th>Bank Branch</th>
                            <th>Brrower Name</th>
                            <th>SRO/ Tehsil</th>
                            <th>Tehsil/SRO</th>
                            
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $item)
                        <tr class="<?php echo App\Models\User::bgClass($item->status); ?>">

                            <td>{{$key+1}}</td>
                            
                            <td>{{ $item->bank_name}}</td>
                            <td>{{ $item->through_type}}</td>
                            
                            <td>{{ $item->day}}</td>
                            <td>{{ $item->show_status}}</td>
                            <td>{{ $item->bank_branch}}</td>
                            <td>{{ $item->borrower_name}}</td>
                            <td>{{ $item->st_type == 1 ? 'SRO' : 'Tehsil'}}</td>
                            <td>{{ $item->tehsil_name}}</td>

                            
                            <td>
                               <a href="{{url('admin/data-entry/noting-charge/add/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a> 
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
    <?php $version = "1.2.4"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/noting_charge_ctrl.js?v='.$version)}}" ></script>

    
@endsection