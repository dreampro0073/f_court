<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

// use App\Models\User;

class AttendanceController extends Controller {

	public function index(){

    	// $months = ['Name','Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec'];


    	$months = [];
    	$months[] = array("id"=>0,"label"=>"Name");
    	$months[] = array("id"=>1,"label"=>"Jan");
    	$months[] = array("id"=>2,"label"=>"Feb");
    	$months[] = array("id"=>3,"label"=>"Mar");
    	$months[] = array("id"=>4,"label"=>"Apr");
    	$months[] = array("id"=>5,"label"=>"May");
    	$months[] = array("id"=>6,"label"=>"June");
    	$months[] = array("id"=>7,"label"=>"July");
    	$months[] = array("id"=>8,"label"=>"Aug");
    	$months[] = array("id"=>9,"label"=>"Sep");
    	$months[] = array("id"=>10,"label"=>"Oct");
    	$months[] = array("id"=>11,"label"=>"Nov");
    	$months[] = array("id"=>12,"label"=>"Dec");

		$users = DB::table("users")->select('name','id','mobile')->get();

		foreach ($users as $key => $user) {

			$attendance_ar = [];

			foreach ($months as $key => $month) {
				if($month['id'] !=0){

					$f_count = DB::table('daily_attendance')->where('attendance',1)->where('user_id',$user->id)->whereMonth('date',$month['id'])->count();
					$h_count = DB::table('daily_attendance')->where('attendance',2)->where('user_id',$user->id)->whereMonth('date',$month['id'])->count();
					$l_count = DB::table('daily_attendance')->where('attendance',3)->where('user_id',$user->id)->whereMonth('date',$month['id'])->count();
					
					$at = array('half_day'=>$h_count,'full_day'=>$f_count,'leave_day'=>$l_count,'month_id'=>$month['id']);

					array_push($attendance_ar,$at);
				}
				
			}

			$user->attendance_ar = $attendance_ar;	
		}
		// dd($users);

		
		return view('admin.attendance.index', [
            "sidebar" => "attendance",
            "subsidebar" => "attendance",
            "users"=>$users,
            "months"=>$months,
        ]);
	}

	public function markAttendance(){
		return view('admin.attendance.mark_attendance', [
            "sidebar" => "attendance",
            "subsidebar" => "attendance",
           
        ]);
	}

	public function showAttendance($user_id=0,$month_id=0){
		$data = DB::table('daily_attendance')->where('user_id',$user_id)->whereMonth('date',$month_id)->get();

		return view('admin.attendance.show_attendance', [
            "sidebar" => "attendance",
            "subsidebar" => "attendance",
            "data" => $data,
           
        ]);
	}


	public function init(Request $request){

		$date = date("Y-m-d");

		// dd($request->all());

		if($request->has('date')){
			$date = date("Y-m-d",strtotime($request->date));
		}

		$users = DB::table("users")->select('name','id','mobile')->where('privilege',1)->get();


		foreach($users as $user){

			$check = DB::table("daily_attendance")->where('date',$date)->where('user_id',$user->id)->first();

			if($check){
				$user->at = $check->attendance;
				$user->date = date("d-m-Y",strtotime($check->date));
			}else{
				$user->at = 0;
				$user->date = date("d-m-Y",strtotime($date));

			}
		}
		

		$data['success'] = true;
		$data['users'] = $users;
		$data['date'] = date("m/d/Y",strtotime($date));

		return Response::json($data,200,array());
	}

	public function store(Request $request){
		$users = $request->users;
		foreach ($users as $key => $user) {

			$date = date("Y-m-d",strtotime($user['date']));

			$check = DB::table("daily_attendance")->where('date',$date)->where('user_id',$user['id'])->first();

			$data = [
				'user_id' => $user['id'],
				'attendance' => $user['at'],
				'date' => $date,
			];

			if(!$check){
				DB::table('daily_attendance')->insert($data);
			}else{
				DB::table('daily_attendance')->where('date',$date)->where('user_id',$user['id'])->update($data);
			}


		}
		

		$data['success'] = true;
		$data['message'] = 'Attendance marked successfully';

		$data['redirect_url'] = url('admin/attendance');
		

		return Response::json($data,200,array());
	}
	
}