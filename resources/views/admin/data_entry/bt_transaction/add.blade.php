@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="btTransCtrl" ng-init="bt_id={{$bt_id}}; add()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add BT Transaction</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/bt-transaction')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="btTrans" novalidate="novalidate" ng-submit="storeBtTrans(btTrans.$valid)">
                <div class="row">
                    
                    <div class="col-md-4 form-group"> 
                        <label>From/ Financed by</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="banks" ng-model="formData.bank_comp_id" required></selectize>
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Department</label>
                        <input type="text" ng-model="formData.department" class="form-control" required>
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Submited To</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="banks" ng-model="formData.submitted_to" required></selectize>
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Transaction Date</label>
                        <input type="text" ng-model="formData.transaction_date" class="form-control datepicker" >
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Case Name</label>
                        <input type="text" ng-model="formData.case_name" class="form-control " required>
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Mobile</label>
                        <input type="text" ng-model="formData.mobile" class="form-control " required>
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Cheque Deposited Date</label>
                        <input type="text" ng-model="formData.cheque_deposited_date" class="form-control datepicker2" >
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Document Collection Date</label>
                        <input type="text" ng-model="formData.document_collection_date" class="form-control datepicker3" >
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Handover Date</label>
                        <input type="text" ng-model="formData.handover_date" class="form-control datepicker4" >
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>TAT</label>
                        <select ng-model="formData.tat" class="form-control" required convert-to-number >
                            <option value="">--select--</option>
                            <option ng-repeat="item in days" value=@{{item.id}}>@{{ item.day}}</option>
                            <option value=-1>New</option>
                        </select> 
                    </div>
                    
                    <div class="col-md-4 form-group" ng-if="formData.tat == -1"> 
                        <label>Number of days</label>
                        <input type="text" placeholder="like : 10 Days" ng-model="formData.new_day" class="form-control" required />
                    </div>

                    <div class="col-md-4 form-group"> 
                        <label>Status</label>
                        <select ng-model="formData.status" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in status_ar" value=@{{item.value}}>@{{ item.label}}</option>
                           
                        </select> 
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Contact no</label>
                        <input type="text" ng-model="formData.contact_no" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Email</label>
                        <input type="email" ng-model="formData.email" class="form-control" required />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button> 
           </form>
        </div>
    </div> 
</div>
@endsection

@section('footer_scripts')
    <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/bt_trans_ctrl.js?v='.$version)}}" ></script>

    
@endsection