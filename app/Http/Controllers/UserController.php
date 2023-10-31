<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Redirect, Validator, Hash, Response, Session, DB;

use App\Models\User;

class UserController extends Controller {

    public function index(){
        // return Hash::make('Thakral@97531');
        return view('index');
    }

	public function login(){
		return view('login');
	}


	public function postLogin(Request $request){

		$cre = ["email"=>$request->input("email"),"password"=>$request->input("password")];
		$rules = ["email"=>"required","password"=>"required"];
		$validator = Validator::make($cre,$rules);
		
        if($validator->passes()){

			
            if(Auth::attempt($cre)){        
                return Redirect::to('/admin/dashboard');

			} else {
                return Redirect::back()->withInput()->with('failure','Invalid username or password');
			}

		} else {
            return Redirect::back()->withErrors($validator)->withInput();
		}

	}

    public function changePassword(){
        return view('update_password');
    }
    
    public function updatePassword(Request $request){
        $cre = ["old_password"=>$request->old_password,"new_password"=>$request->new_password,"confirm_password"=>$request->confirm_password];
        $rules = ["old_password"=>'required',"new_password"=>'required|min:5',"confirm_password"=>'required|same:new_password'];
        $old_password = Hash::make($request->old_password);
        $validator = Validator::make($cre,$rules);
        if ($validator->passes()) { 
            if (Hash::check($request->old_password, Auth::user()->password )) {
                $password = Hash::make($request->new_password);
                $user = User::find(Auth::id());
                $user->password = $password;
                $user->password_check = $request->new_password;
                $user->save();
                
                return Redirect::back()->with('success', 'Password changed successfully ');
                
            } else {
                return Redirect::back()->withInput()->with('failure', 'Old password does not match.');
            }
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::back()->withErrors($validator)->withInput()->with('failure','Unauthorised Access or Invalid Password');
    }


    public function usersList(){

        $data = DB::table('users')->get();

        return view('admin.users.index', [
            "sidebar" => "users",
            "subsidebar" => "users",
            "data" =>$data,
        ]);
    }

    public function addUser($user_id = 0){
        return view('admin.users.add', [
            "sidebar" => "users",
            "subsidebar" => "users",
    
            "user_id"=>$user_id,
        ]);
    }

    public function initUser(Request $request){


        $user = DB::table('users')->where('id',$request->user_id)->first();

        $data['success'] = true;
        $data['user'] = $user;

        return Response::json($data,200,array());
    }

    public function storeUser(Request $request){
        $cre = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,

        
        ];


        $rules = [
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ];

        if(!$request->has('id')){
            $cre['email'] = $request->email;   
            $cre['password'] = $request->password;
            $cre['confirm_password'] = $request->confirm_password;

            $rules['email'] = 'required|unique:users';
            $rules['password'] = 'required';
            $rules['confirm_password'] = 'required|same:password';

        }

        // dd()

        $validator = Validator::make($cre,$rules);

        if($validator->passes()){

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
            ];

            if($request->has('id')){

                DB::table('users')->where('id',$request->id)->update($data);
                
                $data['message'] = 'Successfully Update';

            }else{
                $data['password'] = Hash::make($request->password);
                $data['password_check'] = $request->password;
                $data['privilege'] = 2;
                DB::table('users')->insert($data);

                $data['message'] = 'Successfully Added';
            }
            $data['success'] = true;

            $data['redirect_url'] = url('admin/users');

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

    public function addMessage(Request $request){
        DB::table('messages')->insert([
            'message' => $request->message,
            'date' => date("Y-m-d"),
        ]);

        $data['success'] = true;
        $data['message'] = 'Added';

        return Response::json($data,200,array());
    }



   

    
}