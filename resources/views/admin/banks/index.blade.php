@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="bankCtrl" >

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Banks List</h1>
        </div>
        <div class="col-md-6 text-right">
            <button ng-click="addBank()" class="btn btn-primary">Add Bank</button>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Bank Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banks_list as $key => $data)

                        <tr class="<?php echo App\Models\User::bgClass($data->status); ?>">
                            <td>{{ $key+1}}</td>
                            <td>{{ $data->bank_name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal" id="bankModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Bank</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" ng-model="bank_name" class="form-control">
                    </div>

                    <div class="text-right">
                        <button type="button" ng-disabled="purpose_loading" class="btn btn-primary" ng-click="submitBank();">
                            <span ng-if="!purpose_loading">Submit</span>
                            <span ng-if="purpose_loading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>
@endsection

@section('footer_scripts')
    <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/bank_ctrl.js?v='.$version)}}" ></script>

    
@endsection