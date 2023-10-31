<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class DataEntryControllerV1 extends Controller {


	public function index(Request $request){

		$sql = User::getOpinion();

		$legal_opinion_data = $sql->get();

		$st = User::showStatusList();

		foreach ($legal_opinion_data as $key => $item) {
			$item->show_status = (isset($item->status))?$st[$item->status]:'';
		}

		return view('admin.data_entry.type1.index', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            "tab"=>"type1",
            "legal_opinion_data"=>$legal_opinion_data,
        ]);
	}

	public function add($opinion_id = 0){
		return view('admin.data_entry.type1.add', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            'opinion_id' => $opinion_id,
        ]);
	}


	public function init(Request $request){

		$opinion = DB::table('legal_opinion')->find($request->opinion_id);

		if($opinion){
			if($opinion->emi_amount){
				
				$emi_ar = explode(',',$opinion->emi_amount);

				foreach ($emi_ar as $key => $emi) {
					$opinion->emi_ar[] = ['e_amount'=>$emi];
				}
			}else{
				$opinion->emi_ar[] = ['e_amount'=>''];
			}
		}

		$banks = User::getBanks();
		$years = User::getYears();
		$through = User::getThrough();
		$billing_types = User::getBillingTypes();
		$days = User::getDays();
		$status_ar = User::statusList();

		$data['opinion'] = $opinion;
		$data['banks'] = $banks;
		$data['years'] = $years;
		$data['through'] = $through;
		$data['billing_types'] = $billing_types;
		$data['days'] = $days;
		$data['status_ar'] = $status_ar;
		$data['success'] = true;

		return Response::json($data, 200, []);
	}	

	public function store(Request $request){

		$cre = [
			'year_search_id'=>$request->year_search_id,
			'bank_comp_id'=>$request->bank_comp_id,
			'through_id'=>$request->through_id,
			'borrower_name'=>$request->borrower_name
		];

		$rules = [
			'year_search_id'=>'required',
			'bank_comp_id'=>'required',
			'through_id'=>'required',
			'borrower_name'=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){
			
			$through_id = $request->through_id;

			if(isset($request->through_name)){
				$through_id = User::addThrough($request->through_name);
			}
			$billing_type_id = $request->has('billing_type_id')?$request->billing_type_id:0;
			$day_id = $request->has('tat')?$request->tat:0;
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
				'year_search_id'=>$request->year_search_id,
				'bank_comp_id'=>$request->bank_comp_id,
				'borrower_name'=>$request->borrower_name,
				'amount'=>$request->has('amount')?$request->amount:null,
				'billing_type_id'=>$billing_type_id,
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,
				'through_id'=>$through_id,
				'tat'=>$day_id,
				'department_id'=>$request->department_id,
				'branch_id'=>$request->branch_id,
				'status'=>$request->status,
				'emi_amount'=>$emi_str,
			];

			if($request->id){
				$data['updated_at'] = date('Y-m-d H:i:s');
				DB::table('legal_opinion')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				DB::table('legal_opinion')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;
			$data['redirect_url'] = url('admin/data-entry/type1');
		}else{
			$data['success'] = false;
            $error = '';
            $messages = $validator->messages();
            foreach($messages->all() as $message){
                $error = $message;
                break;
            }
            $data['success'] = false;
            $data['message'] = $error;
		}


		return Response::json($data, 200, []);
	}
	
	public function delete($opinion_id){
		DB::table('legal_opinion')->where('id', $opinion_id)->delete();
		return Redirect::back()->with('success', "Delete Successfully");
	}

	function getNameFromNumber($num) {
        $numeric = ($num ) % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval(($num ) / 26) - 1;
        if ($num2 >= 0) {
            return $this->getNameFromNumber($num2) . $letter;
        } else {
            return $letter;
        }
    }

	
}