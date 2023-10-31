@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="userCtrl" ng-init=" user_id = {{$user_id}}; init();">
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
           <form name="userForm" novalidate="novalidate" ng-submit="onSubmit(userForm.$valid)"> 
                <div class="row">
                
                   
                    <div class="col-md-4 form-group">
                        <label>Name</label>
                        <input type="text" ng-model="formData.name" class="form-control form-control-user" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Email</label>
                        <input type="text" ng-model="formData.email" class="form-control form-control-user" required ng-readonly="user_id !=0">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Mobile</label>
                        <input type="text" ng-model="formData.mobile" class="form-control form-control-user" required>
                    </div>
                    <div ng-if="user_id ==0" class="col-md-4 form-group">
                        <label>Password</label>
                        <input type="passwod" ng-model="formData.password" class="form-control form-control-user" required>
                    </div>
                    <div ng-if="user_id ==0" class="col-md-4 form-group">
                        <label>Confirm Password</label>
                        <input type="passwod" ng-model="formData.confirm_password" class="form-control form-control-user" required>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label>Address</label>
                        <input type="text" ng-model="formData.address" class="form-control form-control-user" required>
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/user_ctrl.js?v='.$version)}}" ></script>
@endsection