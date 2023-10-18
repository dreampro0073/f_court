@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="dayBookCtrl">
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
            @include('admin.day_book.add') 

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
                            <th>Folio</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ date("d-m-Y",strtotime($item->date))}}</td>
                            <td>{{ $item->particulars}}</td>
                            <td>{{ $item->folio}}</td>
                            
                            <td>
                              
                               <button class="btn btn-primary btn-sm" ng-click="onEdit({{$item->id}})">Edit</button>
                                
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/day_book_ctrl.js?v='.$version)}}" ></script>

    
@endsection