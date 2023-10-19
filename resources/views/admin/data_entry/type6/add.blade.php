@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="type6Ctrl" ng-init=" court_case_id = {{$court_case_id}}; init();">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Court Case</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type6')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="caseForm" novalidate="novalidate" ng-submit="onSubmit(caseForm.$valid)"> 
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Date</label>
                        <input type="text" ng-model="formData.date" class="form-control datepicker" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>We are for</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="all_banks" ng-model="formData.bank_comp_id" required></selectize>

                    </div>
                    <div class="col-md-4 form-group">
                        <label>Court Name</label>
                        <input type="text" ng-model="formData.court_name" class="form-control form-control-user" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Case Name 1</label>
                        <input type="text" ng-model="formData.case_name_1" class="form-control form-control-user" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Case Name 2</label>
                        <input type="text" ng-model="formData.case_name_2" class="form-control form-control-user" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Case no 1</label>
                        <input type="text" ng-model="formData.case_no_1" class="form-control form-control-user" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Case no 2</label>
                        <input type="text" ng-model="formData.case_no_2" class="form-control form-control-user" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Billing Type</label>
                        <select ng-model="formData.billing_type_id" class="form-control" required >
                            <option value="">--select--</option>
                            <option ng-repeat="item in billing_types" ng-value=@{{item.id}}>@{{ item.bill_type}}</option>
                            <option value="-1">New</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group" ng-if="formData.billing_type_id == -1"> 
                        <label>Billing Name</label>
                        <input type="text" ng-model="formData.billing_name" class="form-control" />
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>TAT</label>
                        <select ng-model="formData.tat" class="form-control" required convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in days" value=@{{item.id}}>@{{ item.day}}</option>
                            <option value=-1>New</option>
                        </select> 
                    </div>
                    <div class="col-md-4 form-group" ng-if="formData.tat == -1"> 
                        <label>Number of days</label>
                        <input type="text" ng-model="formData.new_day" class="form-control"required />
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
                        <input type="text" ng-model="formData.contact_no" class="form-control"  />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Email</label>
                        <input type="text" ng-model="formData.email" class="form-control"  />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Amount</label>
                        <input type="text" ng-model="formData.amount" class="form-control" required />
                    </div>
                      
                </div>
                <h5>Amount EMI</h5>
                <div class="row mb-2" ng-repeat="emi_obj in formData.emi_ar track by $index">
                    <div class="col-md-4">
                        <input type="text" ng-model="emi_obj.e_amount" class="form-control" />
                    </div>
                    <div class="col-md-3 pt-1">
                        <button ng-click="remove($index)" type="button" class="btn btn-sm btn-danger">Remove</button>
                    </div>
                    
                </div>
                <div class="pt-2 mb-4">
                    <button ng-click="addEMI();" type="button" class="btn btn-info">Add Amount</button> 
                </div>
                <button type="submit" class="btn btn-primary">Submit</button> 
           </form>
        </div>
    </div>
    
    
</div>
@endsection

@section('footer_scripts')
   <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/type6_ctrl.js?v='.$version)}}" ></script>
@endsection