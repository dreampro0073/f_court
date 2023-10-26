@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="btTransCtrl">

    @include('admin.data_entry.menu2')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">BT Transaction</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/bt-transaction/add')}}" class="btn btn-primary">Add</a>
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
                            <th>Submited To</th>
                            <th>Transaction Date</th>
                            <th>Case Name</th>
                            <th>Mobile</th>
                            <th>Cheque Deposited Date</th>
                            <th>Document Collection Date </th>
                            <th>Handover Date</th>
                            <th>Status</th>
                            <th>TAT</th>
                    
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $item)
                        <tr class="<?php echo App\Models\User::bgClass2($item->status); ?>">
                            <td>{{$key+1}}</td>
                            <td>{{$item->bank_name}}</td>
                            <td>{{$item->submitted_to}}</td>
                            <td>{{$item->transaction_date}}</td>
                            <td>{{$item->case_name}}</td>
                            <td>{{$item->mobile}}</td>
                            <td>{{$item->cheque_deposited_date}}</td>
                            <td>{{$item->document_collection_date}}</td>
                            <td>{{$item->handover_date}}</td>
                            <td>{{$item->show_status}}</td>
                            <td>{{$item->day}}</td>
                            <td>
                               <a href="{{url('admin/data-entry/bt-transaction/add/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a> 
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/bt_trans_ctrl.js?v='.$version)}}" ></script>

    
@endsection