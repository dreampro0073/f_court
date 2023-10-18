@extends('admin.layout')


@section('header_scripts')
  

@endsection

@section('main')
<div class="main">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Data Entry</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">
      
        <div class="card-body">
           <form>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>First Name</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Last Name</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Email</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Alternamte Email</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Mobile</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Alternate Mobile</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Address</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>State</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>City</label>
                        <input type="text" name="name" class="form-control form-control-user">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button> 
           </form>
        </div>
    </div>
    
    
</div>
@endsection

@section('footer_scripts')
   
@endsection