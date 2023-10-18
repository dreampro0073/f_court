@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main">

   

    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Show Attendence</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{url('admin/attendance/mark')}}" class="btn btn-info">Back</a>
        </div>
    </div>    
    <div class="card shadow mb-4">  
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th >Date</th>
                        <th >Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td >{{date("d-m-Y",strtotime($item->date))}}</td>
                            <td >
                                @if($item->attendance == 1)
                                    <span>Present</span>
                                @elseif($item->attendance == 2)
                                    <span>Absent</span>

                                @elseif($item->attendance == 3)
                                    <span>Half Day</span>
                                @else
                                    <span>NA</span>

                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection

@section('footer_scripts')
    <?php $version = "1.2.3"; ?>
        
    <script type="text/javascript" src="{{url('assets/scripts/core/attendacne_ctrl.js?v='.$version)}}" ></script>
    
@endsection