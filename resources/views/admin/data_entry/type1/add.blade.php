@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="type1Ctrl" ng-init="opinion_id={{$opinion_id}}; addOpinionInit()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Opinion</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type1')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="t1Form" novalidate="novalidate" ng-submit="storeType1(t1Form.$valid)">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Search year</label>
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
                        <label>Department</label>
                        <input type="text" ng-model="formData.department_id" class="form-control" required />
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Branch</label>
                        <input type="text" ng-model="formData.branch_id" class="form-control" required />
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
                        <label>Billing Type</label>
                        <select ng-model="formData.billing_type_id" class="form-control" required >
                            <option value="">--select--</option>
                            <option ng-repeat="item in billing_types" ng-value=@{{item.id}}>@{{ item.bill_type}}</option>
                            <option value="-1">New</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group" ng-if="formData.billing_type_id == 1">
                        <label>Upload Bills<span style="color: red; margin-left: 8px; font-size: 12px;">( Upload JPEG, PNG,pDF )</label>
                        <br>
                        <button type="button" ng-show="formData.bill_file == '' || formData.bill_file == null " class="btn btn-primary btn-sm" ngf-select="uploadFile($file,'bill_file',formData)">Upload</button>

                        <a class="btn btn-sm btn-primary" href="@{{formData.path_url}}" ng-show="formData.bill_file != '' && formData.bill_file != null" target="_blank">View</a>

                        <a class="btn btn-sm btn-danger" ng-click="removeFile(formData,'bill_file')" ng-show="formData.bill_file != '' && formData.bill_file != null ">Delete</a>
                    </div>
                    <div class="col-md-4 form-group" ng-if="formData.billing_type_id == -1"> 
                        <label>Billing Name</label>
                        <input type="text" ng-model="formData.billing_name" class="form-control" />
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label>Borrower Name</label>
                        <input type="text" ng-model="formData.borrower_name" class="form-control" required />
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
                        <label>Amount Involve</label>
                        <input type="text" ng-model="formData.amount" class="form-control" required />
                    </div>

                </div>
                <h6>Amount EMI</h6>
                <div class="row mb-2" ng-repeat="emi_obj in formData.emi_ar track by $index">
                    <div class="col-md-4">
                        <input type="text" ng-model="emi_obj.e_amount" class="form-control" />
                    </div>
                    <div class="col-md-3 pt-1">
                        <button ng-click="remove($index)" type="button" class="btn btn-sm btn-danger">Remove</button>
                    </div>
                    
                </div>
                <div class="pt-2">
                    <button ng-click="addEMI();" type="button" class="btn btn-info">Add Amount</button> 
                </div>
                <div class="pt-4">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                </div>  
                
           </form>
        </div>
    </div> 
</div>
@endsection

@section('footer_scripts')
    <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/type1_ctrl.js?v='.$version)}}" ></script>

    
@endsection