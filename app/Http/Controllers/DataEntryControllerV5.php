<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class DataEntryControllerV5 extends Controller {


	public function index(){

		$sql = User::getMutations();

		$mutations = $sql->get();

		return view('admin.data_entry.type5.index', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            "tab"=>"type5",
            "mutations"=>$mutations,
        ]);
	}

	public function add($mutation_id = 0){
		return view('admin.data_entry.type5.add', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            'mutation_id' => $mutation_id,
        ]);
	}


	public function init(Request $request){

		$mutation = DB::table('mutations')->find($request->mutation_id);

		if($mutation){
			$mutation->date_of_apply = date('m/d/Y', strtotime($mutation->date_of_apply));

			if($mutation->emi_amount){
				
				$emi_ar = explode(',',$mutation->emi_amount);

				foreach ($emi_ar as $key => $emi) {
					$mutation->emi_ar[] = ['e_amount'=>$emi];
				}
			}else{
				$mutation->emi_ar[] = ['e_amount'=>''];
			}

		}

		$tehsils = User::getTehsil();
		$villages = User::getVillages();
		$days = User::getDays();
		$status_ar = User::statusList();

		$data['mutation'] = $mutation;
		$data['tehsils'] = $tehsils;
		$data['villages'] = $villages;
		$data['days'] = $days;
		$data['status_ar'] = $status_ar;
		$data['success'] = true;

		return Response::json($data, 200, []);
	}	

	public function store(Request $request){

		$cre = [
			'tehsil_id' => $request->tehsil_id,
			'name' => $request->name,
			'date_of_apply' => $request->date_of_apply,
			'seller_name' => $request->seller_name,
			'contact_no' => $request->contact_no,
			'purchaser_name' => $request->purchaser_name,
			'village_id' => $request->village_id,
			'total_amount' => $request->total_amount,
			'document_available' => $request->document_available,
		];

		$rules = [
			'tehsil_id' => 'required',
			'name' => 'required',
			'date_of_apply' => 'required',
			'seller_name' => 'required',
			'contact_no' => 'required',
			'village_id' => 'required',
			'purchaser_name' => 'required',
			'total_amount' => 'required',
			'document_available' => 'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$day_id = $request->tat;
			if (isset($request->new_day)) {
				$day_id = User::addDays($request->new_day);
			}

			$tehsil_id = $request->tehsil_id;

			if (isset($request->new_day)) {
				$tehsil_id = User::addTehsil($request->tehsil_name);
			}

			$village_id = $request->village_id;

			if(isset($request->village_name)){
				$village_id = User::addVillage($request->village_name);
			}

			$emi_str = null;
			$emi_str_ar = [];
			if($request->has('emi_ar')){
				if(sizeof($request->emi_ar) > 0){
					foreach ($request->emi_ar as $key => $emi_obj) {
						if(isset($emi_obj['e_amount'])){
							$emi_str_ar[] = $emi_obj['e_amount'];
						}
					}
					$emi_str = implode(',', $emi_str_ar);

				}
			}

			$data= [
				'tehsil_id'=>$tehsil_id,
				'name'=>$request->name,
				'contact_no'=>$request->contact_no,
				'email'=>$request->email,
				'date_of_apply'=>date("Y-m-d",strtotime($request->date_of_apply)),
				'seller_name'=>$request->seller_name,
				'purchaser_name'=>$request->purchaser_name,
				'village_id'=>$village_id,
				'total_amount'=>$request->total_amount,
				'document_available'=>$request->document_available,
				'status'=>$request->status,
				'tat'=>$day_id,
				'emi_amount'=>$emi_str,
				
			];

			if($request->id){
				$data['updated_at'] = date('Y-m-d H:i:s');
				DB::table('mutations')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				DB::table('mutations')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;
			$data['redirect_url'] = url('admin/data-entry/type5');
		} else {
			$data['success'] = false;

		}


		return Response::json($data, 200, []);
	}
	
	public function delete($opinion_id){
		DB::table('mutations')->where('id', $opinion_id)->delete();
		return Redirect::back()->with('success', "Delete Successfully");
	}

	
}