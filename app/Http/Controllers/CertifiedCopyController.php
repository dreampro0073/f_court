<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class CertifiedCopyController extends Controller {
	public function index(){

		$status_ar = User::statusList();
		$sro_ar = User::SROList();

		$data = DB::table('certified_copy')
		->select('certified_copy.*', 'banks.bank_name', 'through.through_type', 'days.day', 'tehsil.tehsil_name')
		->leftJoin('banks', 'banks.id', '=', 'certified_copy.bank_comp_id')
		->leftJoin('through', 'through.id', '=', 'certified_copy.through_id')
		->leftJoin('days', 'days.id', '=', 'certified_copy.tat')
		->leftJoin('tehsil', 'tehsil.id', '=', 'certified_copy.tehsil_id')
		->get();

		$st = User::showStatusList();


		// dd($st);
		foreach ($data as $value) {
			$value->date = ($value->date) ? date('d-m-Y', strtotime($value->date)): '';
			$value->document_date = ($value->document_date) ? date('d-m-Y', strtotime($value->document_date)): null;
			$value->docs_received_on_dated = $value->docs_received_on_dated ? date('d-m-Y', strtotime($value->docs_received_on_dated)): null;
			foreach ($sro_ar as $sro) {
				if($value->sro == $sro['value'] ){
					$value->sro = $sro['label'];
				}
			}

			$value->show_status = (isset($value->status))?$st[$value->status]:'';		
		}

		// dd($data);

		
		return view('admin.data_entry.certified_copy.index', [
            "sidebar" => "entry2",
            "subsidebar" => "entry2",
            "tab"=>"certified-copy",
            "data" =>$data,
        ]);
	}

	public function add($certifide_id = 0){
		return view('admin.data_entry.certified_copy.add', [
			"sidebar" => "entry2",
			"subsidebar" => "entry2",
			"tab"=>"certified-copy",
			"certifide_id"=>$certifide_id,
        ]);
	}

	public function init(Request $request){
		$banks = User::getBanks();
		$certifide_copy = DB::table('certified_copy')->where('id',$request->certifide_id)->first();

		if($certifide_copy){
			$certifide_copy->date = ($certifide_copy->date)?date("m/d/Y",strtotime($certifide_copy->date)):null;
			$certifide_copy->document_date = ($certifide_copy->document_date)?date("m/d/Y",strtotime($certifide_copy->document_date)):null;
			$certifide_copy->docs_received_on_dated = ($certifide_copy->docs_received_on_dated)?date("m/d/Y",strtotime($certifide_copy->docs_received_on_dated)):null;

			// $certifide_copy->sro = 
		}

		$tehsils = User::getTehsil();

		$days = User::getDays();
		$through = User::getThrough();
		$status_ar = User::statusList();
		$sro_ar = User::SROList();


		$data['success'] = true;
		$data['banks'] = $banks;
		$data['certifide_copy'] = $certifide_copy;
		$data['tehsils'] = $tehsils;
		$data['days'] = $days;
		$data['through'] = $through;
		$data['status_ar'] = $status_ar;
		$data['sro_ar'] = $sro_ar;

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
			$day_id = $request->has('tat')?$request->tat:0;
			$tehsil_id = $request->tehsil_id;
			
			if (isset($request->tehsil_name)) {
				$tehsil_id = User::addTehsil($request->tehsil_name);
			}
			$through_id = $request->through_id;

			if(isset($request->through_name)){
				$through_id = User::addThrough($request->through_name);
			}

			$data = [
				'date' =>($request->date) ?date('Y-m-d', strtotime($request->date)):null,
				'bank_comp_id' => $request->bank_comp_id,
				'branch_name' => $request->branch_name,
				'department' => $request->department,
				'file_name' => $request->file_name,
				'first_party' => $request->first_party,
				'second_party' => $request->second_party,
				'document_no' => $request->document_no,
				'document_date' => ($request->document_date)?date('Y-m-d', strtotime($request->document_date)):null,
				'sro' => $request->sro,
				'tehsil_id' => $tehsil_id,
				'tat' => $day_id,
				'through_id' => $through_id,
				'status' => $request->status,
				
				'contact_no'=>$request->has('contact_no')?$request->contact_no:null,
				'email'=>$request->has('email')?$request->email:null,

			];

			if($request->has('id')){

				DB::table('certified_copy')->where('id',$request->id)->update($data);
				
				$data['message'] = 'Successfully Update';

			}else{
				$data["created_at"]=date('Y-m-d h:i:s');

				DB::table('certified_copy')->insert($data);

				$data['message'] = 'Successfully Add';
			}
			$data['success'] = true;

			$data['redirect_url'] = url('admin/data-entry/certified-copy');



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

		
		return Response::json($data,200,array());
	}

	
}