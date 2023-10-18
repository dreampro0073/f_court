<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class DayBookController extends Controller {


	public function index(){

		$data = DB::table('day_books')->get();

		return view('admin.day_book.index', [
            "sidebar" => "day-book",
            "subsidebar" => "day-book",
            "data" => $data,
           
        ]);
	}

	public function initRes(Request $request) {
		$day_book = DB::table('day_books')->where('id',$request->day_book_id)->first();

		$data['success'] = true;
		$data['day_book'] = $day_book;

		return Response::json($data,200,array());
	}
	public function store(Request $request){

		$cre = [
			'date'=>$request->date,
			'particulars'=>$request->particulars,
			'amount'=>$request->amount,
			'folio'=>$request->folio,
		];

		$rules = [
			'date'=>'required',
			'particulars'=>'required',
			'amount'=>'required',
			'folio'=>'required',
		];

		$validator = Validator::make($cre,$rules);

		if($validator->passes()){

			$data = [
				'date'=>($request->date)?date("Y-m-d",strtotime($request->date)):null,
				'particulars'=>$request->particulars,
				'amount'=>$request->amount,
				'folio'=>$request->folio,
			];

			if($request->id){
				$data['created_at'] = date('Y-m-d H:i:s');
				DB::table('day_books')->where('id', $request->id)->update($data);
				$message = "Updated Successfully!";
			} else {
				DB::table('day_books')->insert($data);
				$message = "Stored Successfully!";
			}

			$data['message'] = $message;
			$data['success'] = true;

			$data['redirect_url'] = url('admin/day-book');
		}else{
			$data['message'] = $validator->errors([]);
			$data['success'] = false;
		}
		return Response::json($data, 200, []);
	}
}