@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="type6Ctrl" ng-init="init();">

    @include('admin.data_entry.menu')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Court Case</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type6/add')}}" class="btn btn-primary">Add</a>
        </div>
    </div>    
    <div class="card shadow mb-4">


      
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Bank</th>
                            <th>Case Name</th>
                            <th>Case No.</th>
                            <th>Bill Type</th>
                            <th>Status</th>
                            
                            <th>#</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $sn = 1; ?>
                        @foreach($data as $key => $item)
                        <tr class="<?php echo App\Models\User::bgClass($item->status); ?>">
                            <td>{{$key+1}}</td>
                            <td>{{$item->bank_name}}</td>
                            <td>{{$item->case_name_1}} vs {{$item->case_name_2}}</td>
                            <td>{{$item->case_no_1}} vs {{$item->case_no_2}}</td>
                            <td>{{$item->bill_type}} vs {{$item->case_no_2}}</td>
                            <td>{{$item->show_status}}</td>
                            <td>
                                <a href="{{url('admin/data-entry/type6/add/'.$item->id)}}" class="btn btn-sm btn-warning">Edit</a>
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
    <script type="text/javascript" src="{{url('assets/scripts/core/type6_ctrl.js?v='.$version)}}" ></script>
   
    
@endsection