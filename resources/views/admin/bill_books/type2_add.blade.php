@extends('admin.layout') 

@section('header_scripts') 

@endsection

@section('main')
<div class="main" ng-controller="BillBooks" ng-init="bill_book_id={{$bill_book_id}}; addType2()">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Bill Book</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/bill-books/type2')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form name="t2Form" novalidate="novalidate" ng-submit="storeType2(t2Form.$valid)">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Date</label>
                        <input type="text" ng-model="formData.date" class="form-control datepicker" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Bank</label>
                        <selectize placeholder='Select a bank' config="selectConfig" options="banks" ng-model="formData.bank_comp_id" required></selectize>
                    </div>  
                    <div class="col-md-4 form-group">
                        <label>Department</label>
                        <input type="text" ng-model="formData.department" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Branch</label>
                        <input type="text" ng-model="formData.branch_id" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>For</label>
                        <input type="text" ng-model="formData.for_s" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Particulars</label>
                        <input type="text" ng-model="formData.particulars" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Amount</label>
                        <input type="text" ng-model="formData.amount" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Account Number</label>
                        <input type="text" ng-model="formData.account_no" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Status</label>
                        <input type="text" ng-model="formData.status" class="form-control" required />
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