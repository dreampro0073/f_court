<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class BillBookController extends Controller {


	public function indexType1(){

		$sql = User::getTempBills();

		$temBills = $sql->get();

		return view('admin.bill_books.type1', [
            "sidebar" => "bill-books",
            "subsidebar" => "bill-books",
            "tab"=>'type1',
            "temBills"=>$temBills,
        ]);
	}

	public function addType1($temp_bill_id = 0){
		return view('admin.bill_books.type1_add', [
            "sidebar" => "bill-books",
            "subsidebar" => "bill-books",
            'temp_bill_id' => $temp_bill_id,
        ]);
	}	

	public function initType1(Request $request){

		$tempBill = DB::table('temp_bills')->find($request->temp_bill_id);
		// dd($tempBill->date);
		if($tempBill){
			$tempBill->date = date("m/d/Y",strtotime($tempBill->date));
		}
		$banks = User::getBanks();

		$data['banks'] = $banks;
		$data['tempBill'] = $tempBill;
		$data['success'] = true;

		return Response::json($data, 200, []);
	}	

	public function storeType1(Request $request){

		// dd($request->all());

		$cre = [
			'date'=>$request->date,
			'particulars'=>$request->particulars,
			'payment_type'=>$request->payment_type,
			'payment_type_other'=>$request->payment_type_other,
			'narration'=>$request->narration,
			'by'=>$request->by,
			'bank_id'=>$request->bank_id,
		];

		$rules = [
			'date'=>'required',
			'particulars'=>'required',
			'payment_type'=>'required',
			'payment_type_other'=>'required',
			'narration'=>'required',
			'by'=>'required',
			'bank_id'=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$data= [
				'date'=>date('Y-m-d', strtotime($request->date)),
				'particulars'=>$request->particulars,
				'payment_type'=>$request->payment_type,
				'payment_type_other'=>$request->payment_type_other,
				'narration'=>$request->narration,
				'by'=>$request->by,
				'bank_id'=>$request->bank_id,
			];

			if($request->id){
				$data['created_at'] = date('Y-m-d H:i:s');
				
				DB::table('temp_bills')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				DB::table('temp_bills')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;
			$data['redirect_url'] = url('admin/bill-books/type1');
		}else{
			$data['message'] = $validator->errors();
			$data['success'] = false;
		}


		return Response::json($data, 200, []);
	}
	
	public function deleteType1($temp_bill_id){
		DB::table('temp_bills')->where('id', $temp_bill_id)->delete();
		return Redirect::back()->with('success', "Delete Successfully");
	}
	

	public function indexType2(){

		$sql = User::getBillBooks();

		$billBooks = $sql->get();



		return view('admin.bill_books.type2', [
            "sidebar" => "bill-books",
            "subsidebar" => "bill-books",
            "tab"=>'type2',
            "billBooks"=>$billBooks,
        ]);
	}

	public function addType2($bill_book_id = 0){
		return view('admin.bill_books.type2_add', [
            "sidebar" => "bill-books",
            "subsidebar" => "bill-books",
            'bill_book_id' => $bill_book_id,
        ]);
	}	

	public function initType2(Request $request){

		$tempBill = DB::table('bill_books')->find($request->bill_book_id);

		if($tempBill){
			$tempBill->date = date("m/d/Y",strtotime($tempBill->date));
		}
		$banks = User::getBanks();

		$data['banks'] = $banks;
		$data['tempBill'] = $tempBill;
		$data['success'] = true;

		return Response::json($data, 200, []);
	}	

	public function storeType2(Request $request){

		$cre = [
			'date'=>$request->date,
			'bank_comp_id'=>$request->bank_comp_id,
			'department'=>$request->department,
			'branch_id'=>$request->branch_id,
			'for_s'=>$request->for_s,
			'particulars'=>$request->particulars,
			'amount'=>$request->amount,
			'account_no'=>$request->account_no,
			'status'=>$request->status,
		];

		$rules = [
			'date'=>'required',
			'bank_comp_id'=>'required',
			'department'=>'required',
			'branch_id'=>'required',
			'for_s'=>'required',
			'particulars'=>'required',
			'amount'=>'required',
			'account_no'=>'required',
			'status'=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$data= [
				'date'=>date('Y-m-d', strtotime($request->date)),
				'bank_comp_id'=>$request->bank_comp_id,
				'department'=>$request->department,
				'branch_id'=>$request->branch_id,
				'for_s'=>$request->for_s,
				'particulars'=>$request->particulars,
				'amount'=>$request->amount,
				'account_no'=>$request->account_no,
				'status'=>$request->status,
			];

			if($request->id){
				$data['created_at'] = date('Y-m-d H:i:s');
				DB::table('bill_books')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				DB::table('bill_books')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;
			$data['redirect_url'] = url('admin/bill-books/type2');
		}else{
			$data['message'] = $validator->errors([]);
			$data['success'] = false;
		}


		return Response::json($data, 200, []);
	}
	
	public function deleteType2($bill_book_id){
		DB::table('bill_books')->where('id', $bill_book_id)->delete();
		return Redirect::back()->with('success', "Delete Successfully");
	}
}