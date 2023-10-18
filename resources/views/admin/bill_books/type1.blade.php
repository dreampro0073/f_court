@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="tempBills" ng-init="init();">

    @include('admin.bill_books.menu')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">All Day Books</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/bill-books/type1/add')}}" class="btn btn-primary">Add</a>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Date</th>
                            <th>Particulars</th>
                            <th>Payment Type</th>
                            <th>Other Payment Type</th>
                            <th>Narration</th>
                            <th>BY</th>
                            <th>Bank Name</th>
                            
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($temBills as $key => $data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ date("d-m-Y",strtotime($data->date))}}</td>
                            <td>{{ $data->particulars}}</td>
                            <td>{{ $data->payment_type}}</td>
                            <td>{{ $data->payment_type_other}}</td>
                            <td>{{ $data->narration}}</td>
                            <td>{{ $data->by}}</td>
                            <td>{{ $data->bank_name}}</td>
                            <td>
                               <a href="{{url('admin/bill-books/type1/add/'.$data->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                               <a href="{{url('admin/bill-books/type1/delete/'.$data->id)}}" onclick="return confirm('Are you sure to Delete?');" class="btn btn-danger btn-sm">Delete</a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/bill_book_ctrl.js?v='.$version)}}" ></script>

    
@endsection