<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class DataEntryControllerV4 extends Controller {


	public function index(){

		$sql = User::getDrafting();

		$drafting = $sql->get();

		$st = User::showStatusList();
		
		foreach ($drafting as $key => $item) {
			$item->show_status = (isset($item->status))?$st[$item->status]:'';
		}

		return view('admin.data_entry.type4.index', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            "tab"=>"type4",
            "drafting"=>$drafting,
        ]);
	}

	public function add($draft_id = 0){
		return view('admin.data_entry.type4.add', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            'draft_id' => $draft_id,
        ]);
	}


	public function init(Request $request){

		$draft_data = DB::table('draftings')->find($request->draft_id);

		if($draft_data){
			if($draft_data->emi_amount){
				
				$emi_ar = explode(',',$draft_data->emi_amount);

				foreach ($emi_ar as $key => $emi) {
					$draft_data->emi_ar[] = ['emi_amount'=>$emi];
				}
			}else{
				$draft_data->emi_ar[] = ['emi_amount'=>''];
			}
		}

		$through = User::getThrough();
		$billing_types = User::getBillingTypes();
		$drafts = User::getDraftTypes();
		$days = User::getDays();
		$status_ar = User::statusList();

		$data['draft_data'] = $draft_data;
		$data['drafts'] = $drafts;
		$data['through'] = $through;
		$data['billing_types'] = $billing_types;
		$data['days'] = $days;
		$data['status_ar'] = $status_ar;
		$data['success'] = true;

		return Response::json($data, 200, []);
	}	

	public function store(Request $request){

		$cre = [
			'through_id' => $request->through_id,
			'name' => $request->name,
			'drafting_type_id' => $request->drafting_type_id,
			'billing_type_id' => $request->billing_type_id,
		];

		$rules = [
			'through_id' => 'required',
			'name' => 'required',
			'drafting_type_id' => 'required',
			'billing_type_id' => 'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$day_id = $request->tat;
			if (isset($request->new_day)) {
				$day_id = User::addDays($request->new_day);
			}

			$through_id = $request->through_id;

			if(isset($request->through_name)){
				$through_id = User::addThrough($request->through_name);
			}
			$billing_type_id = $request->billing_type_id;

			if(isset($request->billing_name)){
				$billing_type_id = User::addBilling($request->billing_name);
			}

			$drafting_type_id = $request->drafting_type_id;

			if(isset($request->drafting_name)){
				$drafting_type_id = User::addDraft($request->drafting_name);
			}

			$emi_str = null;
			$emi_str_ar = [];
			if($request->has('emi_ar')){
				if(sizeof($request->emi_ar) > 0){
					foreach ($request->emi_ar as $key => $emi_obj) {
						if(isset($emi_obj['emi_amount'])){
							$emi_str_ar[] = $emi_obj['emi_amount'];
						}
					}
					$emi_str = implode(',', $emi_str_ar);

				}
			}

			$data= [
				'through_id'=>$through_id,
				'billing_type_id'=>$billing_type_id,
				'tat'=>$day_id,
				'name'=>$request->name,
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,
				'drafting_type_id'=>$drafting_type_id,
				'tat'=>$day_id,
				'status'=>$request->status,
				'amount'=>$request->amount,
				'emi_amount'=>$emi_str,

			];

			if($request->id){
				$data['updated_at'] = date('Y-m-d H:i:s');
				DB::table('draftings')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				DB::table('draftings')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;
			$data['redirect_url'] = url('admin/data-entry/type4');
		} else {
			$data['success'] = false;
			$data['message'] = "Please fill required field";
		}


		return Response::json($data, 200, []);
	}
	
	public function delete($opinion_id){
		DB::table('draftings')->where('id', $opinion_id)->delete();
		return Redirect::back()->with('success', "Delete Successfully");
	}

	
}