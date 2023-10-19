<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class WorkstationMutationController extends Controller {
	public function index(){

		$status_ar = User::statusList();
		$data = DB::table('workstation_mutation')->select('workstation_mutation.*','villages.village_name')->leftJoin('villages','villages.id','=','workstation_mutation.village_id')->get();

		foreach ($data as $value) {
			$value->date = $value->date ? date('d-m-Y', strtotime($value->date)): '';
			$value->date_of_apply = $value->date_of_apply ? date('d-m-Y', strtotime($value->date_of_apply)): null;
			$value->next_date = $value->next_date ? date('d-m-Y', strtotime($value->next_date)): null;
			$value->expect_completion_date = $value->expect_completion_date ? date('d-m-Y', strtotime($value->expect_completion_date)): null;
			$value->completion_date = $value->completion_date ? date('d-m-Y', strtotime($value->completion_date)): null;
			
			// foreach ($status_ar as $status) {
			// 	if($value->status == $status['value'] ){

			// 		$value->status = $status['label'];
			// 	}
			// }
		}

		
		return view('admin.data_entry.workstation_mutation.index', [
            "sidebar" => "entry2",
            "subsidebar" => "entry2",
            "tab"=>"workstation-mutation",
            "data" =>$data,
        ]);
	}

	public function add($work_id = 0){
		return view('admin.data_entry.workstation_mutation.add', [
			"sidebar" => "entry2",
			"subsidebar" => "entry2",
			"tab"=>"workstation-mutation",
			"work_id"=>$work_id,
        ]);
	}

	public function init(Request $request){
		$villages = User::getVillages();
		$status_ar = User::statusList();
		$workstation = DB::table('workstation_mutation')->where('id',$request->work_id)->first();

		if($workstation){
			$workstation->completion_date = ($workstation->completion_date)?date("m/d/Y",strtotime($workstation->completion_date)):null;
			$workstation->date = ($workstation->date)?date("m/d/Y",strtotime($workstation->completion_date)):null;
			$workstation->expect_completion_date = ($workstation->expect_completion_date)?date("m/d/Y",strtotime($workstation->expect_completion_date)):null;
			$workstation->date_of_apply = ($workstation->date_of_apply)?date("m/d/Y",strtotime($workstation->date_of_apply)):null;
			$workstation->next_date = ($workstation->next_date)?date("m/d/Y",strtotime($workstation->next_date)):null;
		}

		
		$data['success'] = true;
		$data['villages'] = $villages;
		$data['status_ar'] = $status_ar;
		$data['workstation'] = $workstation;
		
		return Response::json($data,200,array());
	}

	public function store(Request $request){
		$cre = [
			'village_id' => $request->village_id,
			
		];

		$rules = [
			'village_id' => 'required',
			
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$village_id = $request->village_id;

			if(isset($request->village_name)){
				$village_id = User::addVillage($request->village_name);
			}

			$data = [
				'date' => date('Y-m-d', strtotime($request->date)),
				'date_of_apply' => date('Y-m-d', strtotime($request->date_of_apply)),
				'next_date' => date('Y-m-d', strtotime($request->next_date)),
				'expect_completion_date' => date('Y-m-d', strtotime($request->expect_completion_date)),
				'completion_date' => date('Y-m-d', strtotime($request->completion_date)),
				'village_id' => $village_id,
				'applicant_name' => $request->applicant_name,
				'father_name' => $request->father_name,
				'status' => $request->status,
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,
			];

			if($request->has('id')){

				DB::table('workstation_mutation')->where('id',$request->id)->update($data);
				
				$data['message'] = 'Successfully Update';

			}else{
				DB::table('workstation_mutation')->insert($data);

				$data['message'] = 'Successfully Add';
			}
			$data['success'] = true;

			$data['redirect_url'] = url('admin/data-entry/workstation-mutation');



		}else{
			$data['success'] = false;

          

		}

		
		return Response::json($data,200,array());
	}

	
}