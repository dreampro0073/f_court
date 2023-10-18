@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="attendanceCtrl" ng-init="init();">

   

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Mark Attendence</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/attendance')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="row mb-4">
        <div class="col-md-3">
            <label>Date</label>
            <input type="text" ng-model="date" class="form-control datepicker" required />
        </div>
        <div class="col-md-3">
            <div style="margin-top:31px">
                <a href="javascript:;" ng-click="init();" class="btn btn-info">Fetch</a>   
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">  
        <div class="card-body" >
            <div class="" ng-if="!loading" ng-repeat="item in users">
                <div class="d-flex at-row">
                    <div style="width:200px;">
                        <b>@{{item.name}}</b>
                    </div>
                    <div>
                        <label>
                            <input type="radio" ng-model="item.at" ng-value="1"> Present 
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" ng-model="item.at" ng-value="2"> Absent 
                        </label>&nbsp;&nbsp;
                        <label>
                            <input type="radio" ng-model="item.at" ng-value="3"> Half Day 
                        </label>
                    </div>
                </div>
            </div>
            <div ng-if="loading" style="padding-top: 30px;">
                <p>Loading</p>
            </div>
            <button type="button" class="btn btn-primary" ng-click="onSubmit()">
                Mark 
            </button>
        </div>
    </div>
    
    
</div>
@endsection

@section('footer_scripts')
    <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/attendacne_ctrl.js?v='.$version)}}" ></script>
    
@endsection