@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="workCtrl" ng-init="work_id={{$work_id}}; add()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Workstation Mutation</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/workstation-mutation')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="work" novalidate="novalidate" ng-submit="storeWork(work.$valid)">
                <div class="row">
                    
                    <div class="col-md-4 form-group">
                        <label>Date of apply</label>
                        <input type="text" ng-model="formData.date_of_apply" class="form-control datepicker1" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Next date</label>
                        <input type="text" ng-model="formData.next_date" class="form-control datepicker2" />
                    </div>                    
                    
                    <div class="col-md-4 form-group">
                        <label>Applicant Name</label>
                        <input type="text" ng-model="formData.applicant_name" class="form-control" />
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
                        <input type="text" ng-model="formData.village_name" class="form-control"  required />
                    </div>                  
                    <div class="col-md-4 form-group">
                        <label>Expect Completion Date</label>
                        <input type="text" ng-model="formData.expect_completion_date" class="form-control datepicker3" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Completion Date</label>
                        <input type="text" ng-model="formData.completion_date" class="form-control datepicker4" />
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/work_mutation_ctrl.js?v='.$version)}}" ></script>

    
@endsection