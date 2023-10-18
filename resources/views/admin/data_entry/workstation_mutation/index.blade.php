@extends('admin.layout') 

@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="workCtrl">

    @include('admin.data_entry.menu2')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Workstation Mutation</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/workstation-mutation/add')}}" class="btn btn-primary">Add</a>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Date</th>
                            <th>Date of apply</th>
                            <th>Next Date</th>
                            <th>Applicant Name</th>
                            <th>Father Name</th>
                            <th>Village</th>
                            <th>Expect Completion Date</th>
                            <th>Completion Date</th>
                           
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $item)
                        <tr class="<?php echo App\Models\User::bgClass($item->status); ?>">
                            <td>{{$key+1}}</td>
                            <td>{{$item->date}}</td>
                            <td>{{$item->date_of_apply}}</td>
                            <td>{{$item->next_date}}</td>
                            <td>{{$item->applicant_name}}</td>
                            <td>{{$item->father_name}}</td>
                            <td>{{$item->village_name}}</td>
                            <td>{{$item->expect_completion_date}}</td>
                            <td>{{$item->completion_date}}</td>
                           
                            <td>
                               <a href="{{url('admin/data-entry/workstation-mutation/add/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                              
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/work_mutation_ctrl.js?v='.$version)}}" ></script>

    
@endsection