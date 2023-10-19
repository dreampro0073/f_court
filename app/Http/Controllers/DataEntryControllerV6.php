<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class DataEntryControllerV6 extends Controller {
	public function index(){

		$data = DB::table('court_cases')->select('court_cases.*','banks.bank_name','billing_types.bill_type')->leftJoin('billing_types','billing_types.id','=','court_cases.billing_type_id')->leftJoin('banks','banks.id','=','court_cases.bank_comp_id')->get();

		$st = User::showStatusList();
		
		foreach ($data as $key => $item) {
			$item->show_status = (isset($item->status))?$st[$item->status]:'';
		}

		return view('admin.data_entry.type6.index', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            "tab"=>"type6",
            "data" =>$data,
        ]);
	}

	public function add($court_case_id = 0){
		return view('admin.data_entry.type6.add', [
			"sidebar" => "entry",
			"subsidebar" => "entry",
			"tab"=>"type6",
			"court_case_id"=>$court_case_id,
        ]);
	}

	public function init(Request $request){
		$banks = User::getBanks();
		$billing_types = User::getBillingTypes();

		$days = User::getDays();
		$status_ar = User::statusList();

		$court_case = DB::table('court_cases')->where('id',$request->court_case_id)->first();

		if($court_case){
			$court_case->date =($court_case->date)?date("m/d/Y",strtotime($court_case->date)):null;

			if($court_case->emi_amount){
				
				$emi_ar = explode(',',$court_case->emi_amount);

				foreach ($emi_ar as $key => $emi) {
					$court_case->emi_ar[] = ['e_amount'=>$emi];
				}
			}else{
				$court_case->emi_ar[] = ['e_amount'=>''];
			}
		}

		$data['success'] = true;
		$data['banks'] = $banks;
		$data['billing_types'] = $billing_types;
		$data['days'] = $days;
		$data['status_ar'] = $status_ar;
		$data['court_case'] = $court_case;

		return Response::json($data,200,array());
	}

	public function store(Request $request){
		$cre = [
			'bank_comp_id' => $request->bank_comp_id,
			'case_name_1' => $request->case_name_1,
			'case_name_2' => $request->case_name_2,
			'case_no_1' => $request->case_no_1,
			'case_no_2' => $request->case_no_2,
			'billing_type_id' => $request->billing_type_id,
		];

		$rules = [
			'bank_comp_id' => 'required',
			'case_name_1' => 'required',
			'case_name_2' => 'required',
			'case_no_1' => 'required',
			'case_no_2' => 'required',
			'billing_type_id' => 'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$day_id = $request->tat;
			if (isset($request->new_day)) {
				$day_id = User::addDays($request->new_day);
			}

			$billing_type_id = $request->billing_type_id;

			if(isset($request->billing_name)){
				$billing_type_id = User::addBilling($request->billing_name);
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

			$data = [
				'client_name' => $request->client_name,
				'bank_comp_id' => $request->bank_comp_id,
				'case_name_1' => $request->case_name_1,
				'case_name_2' => $request->case_name_2,
				'case_no_1' => $request->case_no_1,
				'case_no_2' => $request->case_no_2,
				'billing_type_id' => $billing_type_id,
				'date' => ($request->date)?date("Y-m-d",strtotime($request->date)):null,
				'next_date' => ($request->next_date)?date("Y-m-d",strtotime($request->next_date)):null,
				'court_name' => $request->court_name,
				'stage' => $request->stage,
				'amount' => $request->amount,
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,
				'status' => $request->status,
				'tat' => $day_id,
				'emi_amount'=>$emi_str,
				

			];

			if($request->has('id')){

				DB::table('court_cases')->where('id',$request->id)->update($data);
				
				$data['message'] = 'Successfully Update';

			}else{
				DB::table('court_cases')->insert($data);

				$data['message'] = 'Successfully Add';
			}
			$data['success'] = true;

			$data['redirect_url'] = url('admin/data-entry/type6');



		}else{
			$data['success'] = false;

          

		}

		
		return Response::json($data,200,array());
	}

	
}