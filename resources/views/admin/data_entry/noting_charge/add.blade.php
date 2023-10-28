@extends('admin.layout')
 
@section('header_scripts')
  
@endsection 

@section('main')
<div class="main" ng-controller="notingCtrl" ng-init="noting_id={{$noting_id}}; add()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Noting of Bank Charge</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/noting-charge')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="t1Form" novalidate="novalidate" ng-submit="storeType1(t1Form.$valid)">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Date</label>
                        <input type="text" ng-model="formData.date" class="form-control datepicker" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Bank</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="banks" ng-model="formData.bank_comp_id" required></selectize>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Bnak Branch</label>
                        <input type="text" ng-model="formData.bank_branch" class="form-control" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Department</label>
                        <input type="text" ng-model="formData.department" class="form-control" />
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
                        <label>Father Name</label>
                        <input type="text" ng-model="formData.father_name" class="form-control" required />
                    </div>

                    <div class="col-md-4 form-group"> 
                        <label>Village</label>
                        <select ng-model="formData.village_id" class="form-control" required convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in villages" value=@{{item.id}}>@{{ item.village_name}}</option>
                            <option value=-1>New</option>
                        </select> 
                    </div>
                    <div class="col-md-4 form-group" ng-if="formData.village_id == -1"> 
                        <label>Village Name</label>
                        <input type="text" ng-model="formData.village_name" class="form-control" />
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>SRO/ Tehsil</label>
                        <select ng-model="formData.st_type" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option value="1">SRO</option>
                            <option value="2">Tehsil</option>
                        </select> 
                    </div>

                    <div class="col-md-4 form-group" ng-if="formData.st_type == 1"> 
                        <label>SRO</label>
                        <select ng-model="formData.sro" class="form-control" required >
                            <option value="">--select--</option>
                            <option value="SRO 1">SRO 1</option>
                            <option value="SRO 2">SRO 2</option>
                            <option value="SRO 3">SRO 3</option>
                        </select> 
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>Tehsil/SRO</label>
                        <select ng-model="formData.tehsil_id" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in tehsils" value=@{{item.id}}>@{{ item.tehsil_name}}</option>
                            <option value=-1>New</option>
                        </select> 
                    </div>
                    <div class="col-md-4 form-group" ng-if="formData.tehsil_id == -1"> 
                        <label>Tehsil Name</label>
                        <input type="text" ng-model="formData.tehsil_name" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group"> 
                        <label>TAT</label>
                        <select ng-model="formData.tat" class="form-control" required convert-to-number >
                            <option value="">--select--</option>
                            <option ng-repeat="item in days" value=@{{item.id}}>@{{ item.day}}</option>
                            
                        </select> 
                    </div>
                    
                    <div class="col-md-4 form-group"> 
                        <label>Status</label>
                        <select ng-model="formData.status" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in status_ar" value=@{{item.value}}>@{{ item.label}}</option>
                           
                        </select> 
                    </div>
                    
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" ng-disabled="loading">
                        <span ng-if="!loading">Submit</span>
                        <span ng-if="loading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    </button> 
                </div>
           </form>
        </div>
    </div> 
</div>
@endsection

@section('footer_scripts')
    <?php $version = "1.2.4"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/noting_charge_ctrl.js?v='.$version)}}" ></script>

    
@endsection