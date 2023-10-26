<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class NotingChargeController extends Controller {
	public function index(){
		$status_ar = User::statusList();

		$data = DB::table('noting_charge')->select('noting_charge.*','banks.bank_name','through.through_type','villages.village_name','tehsil.tehsil_name','days.day')->leftJoin('banks','banks.id','=','noting_charge.bank_comp_id')->leftJoin('through','through.id','=','noting_charge.through_id')->leftJoin('days','days.id','=','noting_charge.tat')->leftJoin('villages','villages.id','=','noting_charge.village_id')->leftJoin('tehsil','tehsil.id','=','noting_charge.tehsil_id')->get();


		$st = User::showStatusList();

		foreach ($data as $item) {
			foreach ($status_ar as $status) {
				$item->show_status = (isset($item->status))?$st[$item->status]:'';
				
			}
		}


		
		return view('admin.data_entry.noting_charge.index', [
            "sidebar" => "entry2",
            "subsidebar" => "entry2",
            "tab"=>"noting-charge",
            "data" =>$data,
        ]);
	}

	public function add($noting_id = 0){
		return view('admin.data_entry.noting_charge.add', [
			"sidebar" => "entry2",
			"subsidebar" => "entry2",
			"tab"=>"noting",
			"noting_id"=>$noting_id,
        ]);
	}

	public function init(Request $request){
		$banks = User::getBanks();
		$notinig_charge = DB::table('noting_charge')->where('id',$request->noting_id)->first();

		if($notinig_charge){
			$notinig_charge->date = ($notinig_charge->date)?date("m/d/Y",strtotime($notinig_charge->date)):null;
		}

		$tehsils = User::getTehsil();
		$villages = User::getVillages();

		$days = User::getDays();
		$through = User::getThrough();
		$status_ar = User::statusList();


		$data['success'] = true;
		$data['banks'] = $banks;
		$data['tehsils'] = $tehsils;
		$data['villages'] = $villages;
		$data['days'] = $days;
		$data['through'] = $through;
		$data['status_ar'] = $status_ar;
		
		$data['notinig_charge'] = $notinig_charge;

		return Response::json($data,200,array());
	}

	public function store(Request $request){
		$cre = [
			'bank_comp_id' => $request->bank_comp_id,
			
		];

		$rules = [
			'bank_comp_id' => 'required',
			
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){
			$day_id = $request->tat;
			if (isset($request->new_day)) {
				$day_id = User::addDays($request->new_day);
			}

			$tehsil_id = $request->tehsil_id;

			if (isset($request->tehsil_name)) {
				$tehsil_id = User::addTehsil($request->tehsil_name);
			}

			$through_id = $request->through_id;

			if(isset($request->through_name)){
				$through_id = User::addThrough($request->through_name);
			}

			$village_id = $request->village_id;

			if(isset($request->village_name)){
				$village_id = User::addVillage($request->village_name);
			}

			$data = [
				'bank_comp_id' => $request->bank_comp_id,
				'bank_branch' => $request->bank_branch,
				'department' => $request->department,
				'through_id' => $through_id,
				'borrower_name' => $request->borrower_name,
				'father_name' => $request->father_name,
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,
				'tat' => $day_id,
				'tehsil_id' => $tehsil_id,
				'village_id' => $village_id,
				'sro' => $request->sro,
				'status' => $request->status,
				'st_type' => $request->st_type,
				'date' => ($request->date)?date("Y-m-d",strtotime($request->date)):null,
			];

			if($request->has('id')){

				DB::table('noting_charge')->where('id',$request->id)->update($data);
				
				$data['message'] = 'Successfully Update';

			}else{
				DB::table('noting_charge')->insert($data);

				$data['message'] = 'Successfully Add';
			}
			$data['success'] = true;
			$data['redirect_url'] = url('admin/data-entry/noting-charge');
		}else{
			$data['success'] = false;          
		}
		return Response::json($data,200,array());
	}

	
}