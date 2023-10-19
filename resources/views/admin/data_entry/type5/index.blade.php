@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="type5Ctrl">

    @include('admin.data_entry.menu')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Mutation</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type5/add')}}" class="btn btn-primary">Add</a>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Tehsil Name</th>
                            <th>Name</th>
                            
                            <th>Date of apply</th>
                            <th>Seller Name</th>
                            <th>Purchaser Name</th>
                            <th>Village</th>
                            <th>Documents</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mutations as $key => $data)
                        <tr class="<?php echo App\Models\User::bgClass($data->status); ?>">
                            <td>{{$key+1}}</td>
                            <td>{{ $data->tehsil_name}}</td>
                            <td>{{ $data->name}}</td>
                            <td>{{ date("d-m-Y",strtotime($data->date_of_apply))}}</td>
                            <td>{{ $data->seller_name}}</td>
                            <td>{{ $data->purchaser_name}}</td>
                            <td>{{ $data->village_name}}</td>
                            <td>
                                @if($data->document_available == 1)
                                    Original Available
                                @elseif($data->document_available == 2)
                                    Certified Copy Available
                                @endif
                            </td>
                            <td>{{ $data->show_status}}</td>

                            <td>
                               <a href="{{url('admin/data-entry/type5/add/'.$data->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                               <a href="{{url('admin/data-entry/type5/delete/'.$data->id)}}" onclick="return confirm('Are you sure to Delete?');" class="btn btn-danger btn-sm">Delete</a> 
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/type5_ctrl.js?v='.$version)}}" ></script>

    
@endsection