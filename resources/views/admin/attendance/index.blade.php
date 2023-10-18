@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="dataEntryCtrl" ng-init="init();">

   

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Attendence</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/attendance/mark')}}" class="btn btn-primary">Mark</a>
        </div>
    </div>    
    <div class="card shadow mb-4">


      
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" cellpadding="1">
                    <thead>
                        <tr>
                            @foreach($months as $month)
                                <th>{{$month['label']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td style="width:150px">
                                   <b>{{$user->name}}</b>
                                </td>
                                @foreach($user->attendance_ar as $item)
                                <td>
                                    <span class="at-type fd">P - <b>{{$item['full_day']}}</b></span>
                                    <span class="at-type hd">H - <b>{{$item['half_day']}}</b></span>
                                    <span class="at-type al">A - <b>{{$item['leave_day']}}</b></span>
                                    <span style="margin-top:5px;display: inline-block;">
                                        <a href="{{url('admin/attendance/show/'.$user->id.'/'.$item['month_id'])}}">View</a>
                                    </span>
                                </td>
                                @endforeach                                
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
   
    
@endsection