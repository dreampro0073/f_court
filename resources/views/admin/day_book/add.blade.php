<form name="t1Form" novalidate="novalidate" ng-submit="store(t1Form.$valid)">
    <div class="row">
       
        
        <div class="col-md-4 form-group">
            <label>Date</label>
            <input type="text" ng-model="formData.date" class="form-control datepicker1" required />
        </div>
        
        <div class="col-md-4 form-group">
            <label>Folio</label>
            <input type="text" ng-model="formData.folio" class="form-control" required />
        </div>
        <div class="col-md-4 form-group">
            <label>Amount</label>
            <input type="text" ng-model="formData.amount" class="form-control" required />
        </div>
        <div class="col-md-8 form-group">
            <label>Particulars</label>
            <input type="text" ng-model="formData.particulars" class="form-control" required />
        </div>
        <div class="col-md-4" style="margin-top:30px;">
            <button type="submit" class="btn btn-primary">Submit</button> 
            
        </div>
       
       

       
    </div>
</form>