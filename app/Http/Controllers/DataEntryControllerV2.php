<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;
// 
use App\Models\User;

class DataEntryControllerV2 extends Controller {
	public function index(){

		$legal_notices_data = DB::table('legal_notices')->select('legal_notices.*', 'billing_types.bill_type','banks.bank_name')->leftJoin('billing_types', 'billing_types.id', '=', 'legal_notices.billing_type_id')->leftJoin('banks','banks.id','=','legal_notices.from_id')->get();

		$st = User::showStatusList();
		

		foreach ($legal_notices_data as $key => $item) {
			$item->show_status = (isset($item->status))?$st[$item->status]:'';
		}
		return view('admin.data_entry.type2.index', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            "tab"=>"type2",
            "legal_notices_data"=>$legal_notices_data,
        ]);
	}

	public function init(Request $request){

		$notice = DB::table('legal_notices')->find($request->notice_id);
		$billing_types = User::getBillingTypes();
		$banks = User::getBanks();
		$status_ar = User::statusList();
		$days = User::getDays();

		if($notice){
			if($notice->emi_amount){
				
				$emi_ar = explode(',',$notice->emi_amount);

				foreach ($emi_ar as $key => $emi) {
					$notice->emi_ar[] = ['e_amount'=>$emi];
				}
			}else{
				$notice->emi_ar[] = ['e_amount'=>''];
			}
		}


		$data['notice'] = $notice;
		$data['billing_types'] = $billing_types;
		$data['banks'] = $banks;
		$data['status_ar'] = $status_ar;
		$data['days'] = $days;
		
		$data['success'] = true;

		return Response::json($data, 200, []);
	}	

	public function add($notice_id = 0){

		return view('admin.data_entry.type2.add', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            'notice_id' => $notice_id,
            "tab"=>"type2",

        ]);
	}


	public function store(Request $request){

		$cre = [
			'type'=>$request->type,
			'from_id'=>$request->from_id,
			'to'=>$request->to,
			
		];

		$rules = [
			'type'=>'required',
			'from_id'=>'required',
			'to'=>'required',
			
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){
			$day_id = $request->has('tat')?$request->tat:0;
			$billing_type_id = $request->has('billing_type_id')?$request->billing_type_id:0;
			$emi_str = null;
			$emi_str_ar = [];
			if($request->has('emi_ar')){
				if(sizeof($request->emi_ar) > 0){
					foreach ($request->emi_ar as $key => $emi_obj) {
						$emi_str_ar[] = isset($emi_obj['e_amount'])?$emi_obj['e_amount']:0;
					}
					$emi_str = implode(',', $emi_str_ar);

				}
			}

			$data= [
				'type'=>$request->type,
				'from_id'=>$request->from_id,
				'to'=>$request->to,
				'next_step'=>$request->has('next_step')?$request->next_step:null,
				'time_given'=>$request->has('time_given')?$request->time_given:null,
				'amount_involved'=>$request->has('amount_involved')?$request->amount_involved:null,
				'billing_type_id'=>$billing_type_id,
				'tat'=>$day_id,
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,
				'status'=>$request->status,
				'total_fees'=>$request->has('total_fees')?$request->total_fees:null,
				'advance_fees'=>$request->has('advance_fees')?$request->advance_fees:null,
				'emi_amount'=>$emi_str,
				


			];

			if($request->id){

				DB::table('legal_notices')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				$data['created_at'] = date('Y-m-d H:i:s');

				DB::table('legal_notices')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;
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

		$data['redirect_url'] = url('admin/data-entry/type2');


		return Response::json($data, 200, []);
	}
	
	public function delete($notice_id){
		DB::table('legal_notices')->where('id', $notice_id)->delete();
		return Redirect::back()->with('success', "Delete Successfully");
	}

	
}