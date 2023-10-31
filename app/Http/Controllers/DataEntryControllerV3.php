<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class DataEntryControllerV3 extends Controller {


	public function index(){	
		$agriFinSql = User::getAgriFin();
		$agricultural_finance = $agriFinSql->get();

		$st = User::showStatusList();
		

		foreach ($agricultural_finance as $key => $item) {
			$item->show_status = (isset($item->status))?$st[$item->status]:'';
		}

		// dd($agricultural_finance);
		return view('admin.data_entry.type3.index', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            "tab"=>"type3",
            'agricultural_finance'=> $agricultural_finance,
        ]);
	}

	public function add($agr_id = 0){
		return view('admin.data_entry.type3.add', [
            "sidebar" => "entry",
            "subsidebar" => "entry",
            'agr_id' => $agr_id,
        ]);
	}


	public function init(Request $request){

		$agri_fin = DB::table('agricultural_finance')->find($request->agr_id);
		if($agri_fin){
			if($agri_fin->emi_amount){
				
				$emi_ar = explode(',',$agri_fin->emi_amount);

				foreach ($emi_ar as $key => $emi) {
					$agri_fin->emi_ar[] = ['e_amount'=>$emi];
				}
			}else{
				$agri_fin->emi_ar[] = ['e_amount'=>''];
			}

			$agri_fin->type = ($agri_fin->type)?intval($agri_fin->type):0;
		}

		$banks = User::getBanks();
		$years = User::getYears();
		$through = User::getThrough();
		$billing_types = User::getBillingTypes();
		$days = User::getDays();
		$status_ar = User::statusList();

		$finance_types = User::financeTypes();


		$data['agri_fin'] = $agri_fin;
		$data['banks'] = $banks;
		$data['years'] = $years;
		$data['through'] = $through;
		$data['billing_types'] = $billing_types;
		$data['days'] = $days;
		$data['finance_types'] = $finance_types;
		$data['status_ar'] = $status_ar;
		$data['success'] = true;

		return Response::json($data, 200, []);
	}	

	public function store(Request $request){

		$cre = [
			'bank_comp_id' => $request->bank_comp_id,
			'through_id' => $request->through_id,
			'borrower_name' => $request->borrower_name,
			// 'amount' => $request->amount,
			
			// 'billing_type_id' => $request->billing_type_id,
			// 'year_search_id' => $request->year_search_id,
			// 'type1' => $request->type,
		];

		$rules = [
			'bank_comp_id' => 'required',
			'through_id' => 'required',
			'borrower_name' => 'required',
			// 'amount' => 'required',
			
			// 'year_search_id' => 'required',
			// 'billing_type_id' => 'required',
			// 'type' => 'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$day_id = $request->has('tat')?$request->tat:0;

			$through_id = $request->through_id;

			if(isset($request->through_name)){
				$through_id = User::addThrough($request->through_name);
			}

			$billing_type_id = $request->has('billing_type_id')?$request->billing_type_id:0;

			$type = $request->has('type')?$request->type:0;
			if(isset($request->finance_name)){
				$type = User::addFin($request->finance_name);

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
				'year_search_id'=>$request->year_search_id,
				'bank_comp_id'=>$request->bank_comp_id,
				'borrower_name'=>$request->borrower_name,
				'amount'=>$request->has('amount')?$request->amount:null,
				'type'=>$type,
				'status'=>$request->status,
				'tat'=>$day_id,
				'through_id'=>$through_id,
				'billing_type_id'=>$billing_type_id,
				'department_id'=>$request->department_id,
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,
				// 'finance_name'=>$request->finance_name,
				'valution_report'=>$request->valution_report,
				'emi_amount'=>$emi_str,

				
			];

			if($request->id){
				$data['updated_at'] = date('Y-m-d H:i:s');
				DB::table('agricultural_finance')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				DB::table('agricultural_finance')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;
			$data['redirect_url'] = url('admin/data-entry/type3');
		} else {
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
	
	public function delete($agri_fin_id){
		DB::table('agricultural_finance')->where('id', $agri_fin_id)->delete();
		return Redirect::back()->with('success', "Delete Successfully");
	}

	
}