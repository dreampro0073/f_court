@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="saleCtrl" ng-init="sale_id={{$sale_id}}; add()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Sale DEED</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/sale-deed')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="sale" novalidate="novalidate" ng-submit="storeSaleDeed(sale.$valid)">
                <div class="row">

                    <div class="col-md-4 form-group">
                        <label>Date</label>
                        <input type="text" ng-model="formData.date" class="form-control datepicker1" />
                    </div>

                    
                    
                    <div class="col-md-4 form-group">
                        <label>Financed by</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="banks" ng-model="formData.bank_comp_id" required></selectize>

                    </div>
                    <div class="col-md-4 form-group">
                        <label>Department</label>
                        <input type="text" ng-model="formData.department_id" class="form-control" required />
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
                        <label>Document Type</label>
                        <select ng-model="formData.document_type_id" class="form-control" required convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in document_types" value=@{{item.id}}>@{{ item.type}}</option>
                            <option value=-1>New</option>

                        </select>
                    </div>

                    <div class="col-md-4 form-group" ng-if="formData.document_type_id == -1"> 
                        <label>Document Name</label>
                        <input type="text" ng-model="formData.document_name" class="form-control" />
                    </div>

                    <div class="col-md-4 form-group">
                        <label>1<sup>st</sup> Party</label>
                        <input type="text" ng-model="formData.first_party" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>2<sup>nd</sup> Party</label>
                        <input type="text" ng-model="formData.second_party" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Document Number</label>
                        <input type="text" ng-model="formData.document_no" class="form-control" required />
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Document Date</label>
                        <input type="text" ng-model="formData.document_date" class="form-control datepicker2" />
                    </div>

                    <div class="col-md-4 form-group" > 
                        <label>SRO</label>
                        <select ng-model="formData.sro" class="form-control" required convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in sro_ar" value="@{{item.value}}">@{{ item.label}}</option>
                        </select> 
                    </div>

                    <div class="col-md-4 form-group"> 
                        <label>SRO Office</label>
                        <select ng-model="formData.sro_office" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in tehsils" value=@{{item.id}}>@{{ item.tehsil_name}}</option>
                            <option value=-1>New</option>
                        </select> 
                    </div>

                    <div class="col-md-4 form-group" ng-if="formData.sro_office == -1"> 
                        <label>SRO Office</label>
                        <input type="text" ng-model="formData.tehsil_name" class="form-control" required />
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
                        <input type="text" placeholder="10 days" ng-model="formData.new_day" class="form-control" required />
                    </div>

                    <div class="col-md-4 form-group"> 
                        <label>Status</label>
                        <select ng-model="formData.status" class="form-control" required  convert-to-number>
                            <option value="">--select--</option>
                            <option ng-repeat="item in status_ar" value=@{{item.value}}>@{{ item.label}}</option>
                           
                        </select> 
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Submitted Date</label>
                        <input type="text" ng-model="formData.submitted_date" class="form-control datepicker3" />
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/sale_deed_ctrl.js?v='.$version)}}" ></script>

    
@endsection