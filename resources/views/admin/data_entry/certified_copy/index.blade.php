@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="certiCopyCtrl">

    @include('admin.data_entry.menu2')

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Certified Copy</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/data-entry/certified-copy/add')}}" class="btn btn-primary">Add</a>
        </div>
    </div>    
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sn.</th>
                            <th>Date</th>
                            <th>Bank</th>
                            <th>Department</th>
                            <th>Through Type</th>
                            <th>File Name</th>
                            <th>First Party</th>
                            <th>Second Party</th>
                            <th>Document Number</th>
                            <th>Document Date</th>
                            <th>SRO</th>
                            <th>SRO Office</th>
                            <th>TAT</th>
                           
                            <th>Document Recived Date</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $item)
                        <tr class="<?php echo App\Models\User::bgClass($item->status); ?>">

                            <td>{{$key+1}}</td>
                            <td>{{date('d-m-Y', strtotime($item->date))}}</td>
                            <td>{{$item->bank_name}}</td>
                            <td>{{$item->department}}</td>
                            <td>{{$item->through_type}}</td>
                            <td>{{$item->file_name}}</td>
                            <td>{{$item->first_party}}</td>
                            <td>{{$item->second_party}}</td>
                            <td>{{$item->document_no}}</td>
                            <td>{{date('d-m-Y', strtotime($item->document_date))}}</td>
                            <td>{{$item->sro}}</td>
                            <td>{{$item->tehsil_name}}</td>
                            <td>{{$item->day}}</td>
                           
                            <td>{{date('d-m-Y', strtotime($item->docs_received_on_dated))}}</td>

                            <td>
                               <a href="{{url('admin/data-entry/certified-copy/add/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a> 
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
        
    <script type="text/javascript" src="{{url('assets/scripts/core/certi_copy_ctrl.js?v='.$version)}}" ></script>

    
@endsection