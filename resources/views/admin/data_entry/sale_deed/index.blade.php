@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="saleCtrl">

    @include('admin.data_entry.menu2')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Sale deed</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/sale-deed/add')}}" class="btn btn-primary">Add</a>
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
                            <th>Financed By</th>
                            <th>Bank</th>
                            <th>Department</th>
                            <th>Through</th>
                            <th>Document Type</th>
                            <th>First Party</th>
                            <th>Second Party</th>
                            <th>Document Number</th>
                            <th>Document Date</th>
                            <th>SRO</th>
                            <th>SRO Office</th>
                            <th>TAT</th>
                            <th>Status</th>
                            <th>Submitted Date</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $item)
                        <tr class="<?php echo App\Models\User::bgClass2($item->status); ?>">
                            <td>{{$key+1}}</td>
                            <td>{{$item->date}}</td>
                            <td>{{$item->financed_by}}</td>
                            <td>{{$item->bank_name}}</td>
                            <td>{{$item->department_id}}</td>
                            <td>{{$item->through_type}}</td>
                            <td>{{$item->document_type}}</td>
                            <td>{{$item->first_party}}</td>
                            <td>{{$item->second_party}}</td>
                            <td>{{$item->document_no}}</td>
                            <td>{{$item->document_date}}</td>
                            <td>{{$item->sro}}</td>
                            <td>{{$item->tehsil_name}}</td>
                            <td>{{$item->tat}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->submitted_date}}</td>
                            
                            <td>
                               <a href="{{url('admin/data-entry/sale-deed/add/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                              
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/sale_deed_ctrl.js?v='.$version)}}" ></script>

    
@endsection