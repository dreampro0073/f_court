@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="type5Ctrl" ng-init="mutation_id={{$mutation_id}}; Init()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Mutation</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/type5')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="t5Form" novalidate="novalidate" ng-submit="storeType5(t5Form.$valid)">
                <div class="row">
                    
                    <div class="col-md-4 form-group"> 
                        <label>Thesil</label>
                        <select ng-model="formData.tehsil_id" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in tehsils" value=@{{item.id}}>@{{ item.tehsil_name}}</option>
                            <option value=-1>New</option>
                        </select> 
                    </div>

                    <div class="col-md-4 form-group" ng-if="formData.tehsil_id == -1"> 
                        <label>Thesil Name</label>
                        <input type="text" ng-model="formData.tehsil_name" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Name</label>
                        <input type="text" ng-model="formData.name" class="form-control" required />
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
                        <label>Date of apply</label>
                        <input type="text" ng-model="formData.date_of_apply" class="form-control datepicker" required />
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label>Seller /First Party Name </label>
                        <input type="text" ng-model="formData.seller_name" class="form-control" required />

                    </div>

                    <div class="col-md-4 form-group">
                        <label>Purchaser /Second Party</label>
                        <input type="text" ng-model="formData.purchaser_name" class="form-control" required />
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
                        <label>Document Available</label>
                        <select ng-model="formData.document_available" class="form-control" required />
                            <option value="">--select--</option>
                            <option ng-value=1>Original Available</option>
                            <option ng-value=2>Certified Copy Available</option>
                            
                        </select>  
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
                        <label>Tat Number of days</label>
                        <input type="text" placeholder="like: 10 Days" ng-model="formData.new_day" class="form-control" required />
                    </div>

                    <div class="col-md-4 form-group"> 
                        <label>Status</label>
                        <select ng-model="formData.status" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in status_ar" value=@{{item.value}}>@{{ item.label}}</option>
                           
                        </select> 
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Total Amount</label>
                        <input type="text" ng-model="formData.total_amount" class="form-control" required />
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/type5_ctrl.js?v='.$version)}}" ></script>

    
@endsection