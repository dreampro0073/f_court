<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class SaleDeedController extends Controller {
	public function index(){

		$data = DB::table('sale_deed')
		->select('sale_deed.*','banks.bank_name','tehsil.tehsil_name','days.day','through.through_type','document_types.type as document_type')
		->leftJoin('banks','banks.id','=','sale_deed.bank_comp_id')
		->leftJoin('days','days.id','=','sale_deed.tat')
		->leftJoin('tehsil','tehsil.id','=','sale_deed.sro_office')
		->leftJoin('through','through.id','=','sale_deed.through_id')
		->leftJoin('document_types','document_types.id','=','sale_deed.document_type_id')
		->get();
		// dd($data);

		$status_ar = User::statusList2();
		$sro_ar = User::SROList();

		foreach ($data as $value) {
			$value->date = $value->date ? date('d-m-Y', strtotime($value->date)): '';
			$value->document_date = $value->document_date ? date('d-m-Y', strtotime($value->document_date)): null;
			$value->submitted_date = $value->submitted_date ? date('d-m-Y', strtotime($value->submitted_date)): null;
			foreach ($sro_ar as $sro) {
				if($value->sro == $sro['value'] ){
					$value->sro = $sro['label'];
				}
			}
			// foreach ($status_ar as $status) {
			// 	if($value->status == $status['value'] ){

			// 		$value->status = $status['label'];
			// 	}
			// }
		}

		
		return view('admin.data_entry.sale_deed.index', [
            "sidebar" => "entry2",
            "subsidebar" => "entry2",
            "tab"=>"sale-deed",
            "data" =>$data,
        ]);
	}

	public function add($sale_id = 0){
		return view('admin.data_entry.sale_deed.add', [
			"sidebar" => "entry2",
			"subsidebar" => "entry2",
			"tab"=>"sale-deed",
			"sale_id"=>$sale_id,
        ]);
	}

	public function init(Request $request){
		$banks = User::getBanks();
		$sale_deed = DB::table('sale_deed')->where('id',$request->sale_id)->first();

		if($sale_deed){
			$sale_deed->document_date = ($sale_deed->document_date)?date("m/d/Y",strtotime($sale_deed->document_date)):null;
			$sale_deed->submitted_date = ($sale_deed->submitted_date)?date("m/d/Y",strtotime($sale_deed->submitted_date)):null;
			$sale_deed->date = ($sale_deed->date)?date("m/d/Y",strtotime($sale_deed->date)):null;

		}

		$tehsils = User::getTehsil();
		$days = User::getDays();
		$status_ar = User::statusList2();
		$sro_ar = User::SROList();
		$through = User::getThrough();
		$document_types = User::getDocumentTypes();



		$data['success'] = true;
		$data['banks'] = $banks;
		$data['tehsils'] = $tehsils;
		$data['days'] = $days;
		$data['sro_ar'] = $sro_ar;
		$data['status_ar'] = $status_ar;
		$data['through'] = $through;
		$data['document_types'] = $document_types;
		
		$data['sale_deed'] = $sale_deed;

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

			$through_id = $request->through_id;

			if(isset($request->through_name)){
				$through_id = User::addThrough($request->through_name);
			}

			$document_type_id = $request->document_type_id;

			if(isset($request->document_name)){
				$document_type_id = User::addDocumentType($request->document_name);
			}

			$sro_office = $request->sro_office;

			if (isset($request->tehsil_name)) {
				$sro_office = User::addTehsil($request->tehsil_name);
			}

			$data = [
				'date' => date('Y-m-d', strtotime($request->date)),
				'bank_comp_id' => $request->bank_comp_id,
				'financed_by' => $request->financed_by,
				'department_id' => $request->department_id,
				
				'first_party' => $request->first_party,
				'second_party' => $request->second_party,
				'document_no' => $request->document_no,
				'document_date' => date('Y-m-d', strtotime($request->document_date)),
				'submitted_date' => date('Y-m-d', strtotime($request->submitted_date)),
				'sro' => $request->sro,
				'tat' => $day_id,
				'sro_office' => $sro_office,
				'through_id' => $through_id,
				'document_type_id' => $document_type_id,
				'status' => $request->status,
				'contact_no' => $request->contact_no,
				'email' => $request->email,
				
			];

			if($request->has('id')){

				DB::table('sale_deed')->where('id',$request->id)->update($data);
				
				$data['message'] = 'Successfully Update';

			}else{
				$data['created_at'] = date('Y-m-d h:i:s');
				DB::table('sale_deed')->insert($data);

				$data['message'] = 'Successfully Add';
			}
			$data['success'] = true;

			$data['redirect_url'] = url('admin/data-entry/sale-deed');



		}else{
			$data['success'] = false;

          

		}

		
		return Response::json($data,200,array());
	}

	
}