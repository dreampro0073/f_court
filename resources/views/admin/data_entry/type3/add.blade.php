@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="type3Ctrl" ng-init="agr_id={{$agr_id}}; init()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Agricultural Finance</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type3')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
        <div class="card-body">
           <form name="t3Forn" novalidate="novalidate" ng-submit="storeType3(t3Forn.$valid)">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Year for Search</label>
                        <select ng-model="formData.year_search_id" class="form-control" required >
                            <option value="">--select--</option>
                            <option ng-repeat="item in years" ng-value=@{{item.id}}>@{{ item.ys_name}}</option>
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Bank</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="banks" ng-model="formData.bank_comp_id" required></selectize>
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Depratment</label>
                        <input type="text" ng-model="formData.department_id" class="form-control" />
                    </div>

                    <div class="col-md-4 form-group"> 
                        <label>Valution Report</label><br>
                        <label><input type="radio" ng-model="formData.valution_report"  ng-value="1">&nbsp;Yes</label>&nbsp;&nbsp;
                        <label><input type="radio" ng-model="formData.valution_report"  ng-value="2">&nbsp;No</label>
                    </div>

                    
                    <div class="col-md-4 form-group">
                        <label>Finance Type</label>
                        <select ng-model="formData.type" class="form-control" required >
                            <option value="">--select--</option>
                            <option value='KCC'>KCC </option>
                            <option value='Green Card'>Green Card </option>
                            <option value='Tractor'>Tractor</option>
                            <option value='-1'>New</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group" ng-if="formData.type == -1"> 
                        <label>Finance Name</label>
                        <input type="text" ng-model="formData.finance_name" class="form-control" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Through</label>
                        <select ng-model="formData.through_id" class="form-control" required convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in through" value=@{{item.id}}>@{{ item.through_type}}</option>
                            <option value=-1>New</option>

                        </select>
                    </div>

                    <div class="col-md-4 form-group" ng-if="formData.through_id == -1"> 
                        <label>Through By</label>
                        <input type="text" ng-model="formData.through_name" class="form-control" />
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Borrower Name</label>
                        <input type="text" ng-model="formData.borrower_name" class="form-control" required />
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
                        <input type="text" ng-model="formData.contact_no" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Email</label>
                        <input type="text" ng-model="formData.email" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Invoice Amount</label>
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/type3_ctrl.js?v='.$version)}}" ></script>

    
@endsection