<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class BtTransactionController extends Controller {
	public function index(){

		$status_ar = User::statusList2();

		$data = DB::table('transactions')->select('transactions.*', 'banks.bank_name', 'days.day','b2.bank_name as submitted_to')
		->leftJoin('banks', 'banks.id', '=', 'transactions.bank_comp_id')
		->leftJoin('banks as b2', 'b2.id', '=', 'transactions.submitted_to')
		->leftJoin('days', 'days.id', '=', 'transactions.tat')
		->get();

		foreach ($data as $value) {
			$value->transaction_date = $value->transaction_date ? date('d-m-Y', strtotime($value->transaction_date)): '';
			$value->cheque_deposited_date = $value->cheque_deposited_date ? date('d-m-Y', strtotime($value->cheque_deposited_date)): '';
			$value->document_collection_date = $value->document_collection_date ? date('d-m-Y', strtotime($value->document_collection_date)): '';
			$value->handover_date = $value->handover_date ? date('d-m-Y', strtotime($value->handover_date)): '';
			// foreach ($status_ar as $status) {
			// 	if($value->status == $status['value'] ){

			// 		$value->status = $status['label'];
			// 	}
			// }
		}
	
		return view('admin.data_entry.bt_transaction.index', [
            "sidebar" => "entry2",
            "subsidebar" => "entry2",
            "tab"=>"bt-transaction",
            "data" =>$data,
        ]);
	}

	public function add($bt_id = 0){
		return view('admin.data_entry.bt_transaction.add', [
			"sidebar" => "entry2",
			"subsidebar" => "entry2",
			"tab"=>"bt-transaction",
			"bt_id"=>$bt_id,
        ]);
	}

	public function init(Request $request){
		$banks = User::getBanks();
		$bt_trans = DB::table('transactions')->where('id',$request->bt_id)->first();

		if($bt_trans){
			$bt_trans->cheque_deposited_date = ($bt_trans->cheque_deposited_date)?date("m/d/Y",strtotime($bt_trans->cheque_deposited_date)):null;
			$bt_trans->transaction_date = ($bt_trans->transaction_date)?date("m/d/Y",strtotime($bt_trans->transaction_date)):null;
			$bt_trans->handover_date = ($bt_trans->handover_date)?date("m/d/Y",strtotime($bt_trans->handover_date)):null;
			$bt_trans->document_collection_date = ($bt_trans->document_collection_date)?date("m/d/Y",strtotime($bt_trans->document_collection_date)):null;

		}

		$days = User::getDays();
		$status_ar = User::statusList2();

		$data['success'] = true;
		$data['banks'] = $banks;
		$data['days'] = $days;
		$data['status_ar'] = $status_ar;
		$data['bt_trans'] = $bt_trans;

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

			$data = [
				'bank_comp_id' => $request->bank_comp_id,
				'department' => $request->department,
				'submitted_to' => $request->submitted_to,
				'transaction_date' => date('Y-m-d', strtotime($request->transaction_date)),
				'cheque_deposited_date' => date('Y-m-d', strtotime($request->cheque_deposited_date)),
				'document_collection_date' => date('Y-m-d', strtotime($request->document_collection_date)),
				'handover_date' => date('Y-m-d', strtotime($request->handover_date)),
				'case_name' => $request->case_name,
				'mobile' => $request->mobile,
				'tat' => $day_id,
				'status' => $request->status,
				'contact_no' => $request->contact_no,
				'email' => $request->email,
			];

			if($request->has('id')){

				DB::table('transactions')->where('id',$request->id)->update($data);
				
				$data['message'] = 'Successfully Update';

			}else{

				$data["created_at"]=date('Y-m-d h:i:s');
				DB::table('transactions')->insert($data);

				$data['message'] = 'Successfully Add';
			}
			$data['success'] = true;

			$data['redirect_url'] = url('admin/data-entry/bt-transaction');

		}else{
			$data['success'] = false;

          

		}

		
		return Response::json($data,200,array());
	}

	
}