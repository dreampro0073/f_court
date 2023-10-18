@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main" ng-controller="tempBills" ng-init="temp_bill_id={{$temp_bill_id}}; addTempInit()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Temp Bill</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/bill-books/type1')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="t1Form" novalidate="novalidate" ng-submit="storeType1(t1Form.$valid)">
                <div class="row">
                   
                    
                    <div class="col-md-4 form-group">
                        <label>Date</label>
                        <input type="text" ng-model="formData.date" class="form-control datepicker" required />
                    </div>
                   <div class="col-md-4 form-group">
                        <label>particulars</label>
                        <input type="text" ng-model="formData.particulars" class="form-control" required />
                    </div>
                   <div class="col-md-4 form-group">
                        <label>Payment Type</label>
                        
                        <select ng-model="formData.payment_type" class="form-control" required>
                            <option value="">--Select--</option>
                            <option value="Cash">Cash</option>
                            <option value="UPI">UPI</option>
                        </select>
                    </div>
                   <div class="col-md-4 form-group">
                        <label>Payment Type Other</label>
                        <input type="text" ng-model="formData.payment_type_other" class="form-control" required />
                    </div>
                   <div class="col-md-4 form-group">
                        <label>Narration</label>
                        <input type="text" ng-model="formData.narration" class="form-control" required />
                    </div>
                   <div class="col-md-4 form-group">
                        <label>BY</label>
                        <input type="text" ng-model="formData.by" class="form-control" required />
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Bank</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="banks" ng-model="formData.bank_id" required></selectize>

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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/bill_book_ctrl.js?v='.$version)}}" ></script>

    
@endsection