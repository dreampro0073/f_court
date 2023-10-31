<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class AdminController extends Controller {

	public function dashboard(Request $request){

		$legal_opinion_count = DB::table('legal_opinion')->where('status',2)->count();
		$legal_notices_count = DB::table('legal_notices')->where('status',2)->count();
		$agricultural_finance_count = DB::table('agricultural_finance')->where('status',2)->count();
		$draftings_count = DB::table('draftings')->where('status',2)->count();
		$mutations_count = DB::table('mutations')->where('status',2)->count();
		$court_cases_count = DB::table('court_cases')->where('status',2)->count();


		$show_message = DB::table('messages')->where('date',date("Y-m-d"))->first();

		$data = [];
		$data[] = ['label'=>'Legal Opinion','count'=>$legal_opinion_count,'url'=>url('admin/data-entry/type1')];
		$data[] = ['label'=>'Legal Notice','count'=>$legal_notices_count,'url'=>url('admin/data-entry/type2')];
		$data[] = ['label'=>'Agricultural Finance','count'=>$agricultural_finance_count,'url'=>url('admin/data-entry/type3')];
		$data[] = ['label'=>'Draftings','count'=>$draftings_count,'url'=>url('admin/data-entry/type4')];
		$data[] = ['label'=>'Mutation','count'=>$mutations_count,'url'=>url('admin/data-entry/type5')];
		$data[] = ['label'=>'Court Cases','count'=>$court_cases_count,'url'=>url('admin/data-entry/type6')];


		return view('admin.dashboard', [
            "sidebar" => "dashboard",
            "subsidebar" => "dashboard",
            "data" => $data,
            "show_message" => $show_message,
           
        ]);
	}

	public function test(){
		for ($i=1; $i <=45 ; $i++) { 
			DB::table('days')->insert(['day'=>$i.' Days','status'=>0]);
		}
	}

	public function uploadFile(Request $request){   
        $destination = 'files/';

        if($request->file('media')){
	        $file = $request->file('media');
	   

	        $extension = $request->file('media')->getClientOriginalExtension();
	        
	        $name = $file->getClientOriginalName();
        	$name = User::getFileName($name, $extension);

            $file = $file->move($destination, $name);

            $data["success"] = true;
            $data["path"] = $destination.$name;
            $data["path_url"] = url($destination.$name);

	    }else{
	        $data['success'] = false;
	        $data['message'] ='file not found';
    	}
        return Response::json($data, 200, array());

    }


    public function banksList(){
    	$banks_list = DB::table('banks')->get();

    	return view('admin.banks.index', [
            "sidebar" => "banks",
            "subsidebar" => "banks",
            "banks_list" => $banks_list,
        ]);
    }

	
  	public function storeBanks(Request $request){
  		DB::table('banks')->insert([
  			'bank_name' => $request->bank_name,
  		]);
  		$data['success'] = true;
  		$data['message'] = 'Successfully Updated!'; 
  		return Response::json($data, 200, array());
  	}

}