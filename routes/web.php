<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataEntryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DataEntryControllerV1;
use App\Http\Controllers\DataEntryControllerV2;
use App\Http\Controllers\DataEntryControllerV3;
use App\Http\Controllers\DataEntryControllerV4;
use App\Http\Controllers\DataEntryControllerV5;
use App\Http\Controllers\DataEntryControllerV6;
use App\Http\Controllers\BillBookController;
use App\Http\Controllers\NotingChargeController;
use App\Http\Controllers\CertifiedCopyController;
use App\Http\Controllers\WorkstationMutationController;
use App\Http\Controllers\BtTransactionController;
use App\Http\Controllers\SaleDeedController;
use App\Http\Controllers\DayBookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [UserController::class,'signUp']);
// Route::post('/sign-up', [UserController::class,'postSignUp']);

Route::get('/', [UserController::class,'index']);
Route::get('/login', [UserController::class,'login'])->name("login");
Route::post('/login', [UserController::class,'postLogin']);
Route::post('/add-message', [UserController::class,'addMessage']);


Route::get('/logout',function(){
	Auth::logout();
	return Redirect::to('/');
});


Route::group(['middleware'=>'auth'],function(){

	Route::group(['prefix'=>"admin"], function(){

	Route::post('/upload-file',[AdminController::class,'uploadFile']);

	Route::get('/dashboard',[AdminController::class,'dashboard']);
	Route::get('/test',[AdminController::class,'test']);
		Route::group(['prefix'=>"data-entry"], function(){
			Route::group(['prefix'=>"type1"], function(){
				Route::get('/',[DataEntryControllerV1::class, 'index']);
				Route::get('/add/{opinion_id?}',[DataEntryControllerV1::class, 'add']);
				Route::get('/delete/{opinion_id}',[DataEntryControllerV1::class, 'delete']);		
			});

			Route::group(['prefix'=>"type2"], function(){
				Route::get('/',[DataEntryControllerV2::class, 'index']);
				Route::get('/add/{notice_id?}',[DataEntryControllerV2::class, 'add']);
				Route::get('/delete/{notice_id}',[DataEntryControllerV2::class, 'delete']);;

			});

			Route::group(['prefix'=>"type3"], function(){
				Route::get('/',[DataEntryControllerV3::class, 'index']);
				Route::get('/add/{notice_id?}',[DataEntryControllerV3::class, 'add']);
				Route::get('/delete/{notice_id}',[DataEntryControllerV3::class, 'delete']);;

			});

			Route::group(['prefix'=>"type4"], function(){
				Route::get('/',[DataEntryControllerV4::class, 'index']);
				Route::get('/add/{notice_id?}',[DataEntryControllerV4::class, 'add']);
				Route::get('/delete/{notice_id}',[DataEntryControllerV4::class, 'delete']);;

			});

			Route::group(['prefix'=>"type5"], function(){
				Route::get('/',[DataEntryControllerV5::class, 'index']);
				Route::get('/add/{notice_id?}',[DataEntryControllerV5::class, 'add']);
				Route::get('/delete/{notice_id}',[DataEntryControllerV5::class, 'delete']);;

			});

			Route::group(['prefix'=>"type6"], function(){
				Route::get('/',[DataEntryControllerV6::class, 'index']);
				Route::get('/add/{court_case_id?}',[DataEntryControllerV6::class, 'add']);

			});

			Route::group(['prefix'=>"noting-charge"], function(){
				Route::get('/',[NotingChargeController::class, 'index']);
				Route::get('/add/{noting_id?}',[NotingChargeController::class, 'add']);

			});
			
			Route::group(['prefix'=>"certified-copy"], function(){
				Route::get('/',[CertifiedCopyController::class, 'index']);
				Route::get('/add/{certifide_id?}',[CertifiedCopyController::class, 'add']);

			});
			
			Route::group(['prefix'=>"workstation-mutation"], function(){
				Route::get('/',[WorkstationMutationController::class, 'index']);
				Route::get('/add/{work_id?}',[WorkstationMutationController::class, 'add']);

			});
			
			Route::group(['prefix'=>"sale-deed"], function(){
				Route::get('/',[SaleDeedController::class, 'index']);
				Route::get('/add/{noting_id?}',[SaleDeedController::class, 'add']);

			});
			
			Route::group(['prefix'=>"bt-transaction"], function(){
				Route::get('/',[BtTransactionController::class, 'index']);
				Route::get('/add/{noting_id?}',[BtTransactionController::class, 'add']);

			});
		});
		
		Route::group(['prefix'=>"banks"], function(){
			Route::get('/',[AdminController::class, 'banksList']);

		});
			
			

		

		Route::group(['prefix'=>"users"], function(){
			Route::get('/',[UserController::class, 'usersList']);
			Route::get('/add/{user_id?}',[UserController::class, 'addUser']);

		});	

		Route::group(['prefix'=>"attendance"], function(){
			Route::get('/',[AttendanceController::class, 'index']);
			Route::get('/mark',[AttendanceController::class, 'markAttendance']);
			Route::get('/show/{user_id}/{month_id}',[AttendanceController::class, 'showAttendance']);
		});

		Route::group(['prefix'=>"bill-books"], function(){
			Route::group(['prefix'=>"type1"], function(){
				Route::get('/',[BillBookController::class, 'indexType1']);
				Route::get('/add/{temp_bill_id?}',[BillBookController::class, 'addType1']);
				Route::get('/delete/{temp_bill_id}',[BillBookController::class, 'deleteType1']);		

			});
			
			Route::group(['prefix'=>"type2"], function(){
				Route::get('/',[BillBookController::class, 'indexType2']);
				Route::get('/add/{book_bill_id?}',[BillBookController::class, 'addType2']);
				Route::get('/delete/{book_bill_id}',[BillBookController::class, 'deleteType2']);		

			});
		});

		Route::group(['prefix'=>"day-book"], function(){
			Route::get('/',[DayBookController::class, 'index']);
		});
	});
});

Route::group(['prefix'=>"api"], function(){


	Route::group(['prefix'=>"data-entry"], function(){

		Route::group(['prefix'=>"type1"], function(){
			Route::post('/init',[DataEntryControllerV1::class, 'init']);
			Route::post('/store',[DataEntryControllerV1::class, 'store']);

		});

		Route::group(['prefix'=>"type2"], function(){
			Route::post('/init',[DataEntryControllerV2::class, 'init']);
			Route::post('/store',[DataEntryControllerV2::class, 'store']);

		});

		Route::group(['prefix'=>"type3"], function(){
			Route::post('/init',[DataEntryControllerV3::class, 'init']);
			Route::post('/store',[DataEntryControllerV3::class, 'store']);

		});

		Route::group(['prefix'=>"type4"], function(){
			Route::post('/init',[DataEntryControllerV4::class, 'init']);
			Route::post('/store',[DataEntryControllerV4::class, 'store']);

		});

		Route::group(['prefix'=>"type5"], function(){
			Route::post('/init',[DataEntryControllerV5::class, 'init']);
			Route::post('/store',[DataEntryControllerV5::class, 'store']);

		});

		Route::group(['prefix'=>"type6"], function(){
			Route::post('/init',[DataEntryControllerV6::class, 'init']);
			Route::post('/store',[DataEntryControllerV6::class, 'store']);

		});

		Route::group(['prefix'=>"noting-charge"], function(){
			Route::post('/init',[NotingChargeController::class, 'init']);
			Route::post('/store',[NotingChargeController::class, 'store']);

		});
		
		Route::group(['prefix'=>"certified-copy"], function(){
			Route::post('/init',[CertifiedCopyController::class, 'init']);
			Route::post('/store',[CertifiedCopyController::class, 'store']);

		});
		
		Route::group(['prefix'=>"workstation-mutation"], function(){
			Route::post('/init',[WorkstationMutationController::class, 'init']);
			Route::post('/store',[WorkstationMutationController::class, 'store']);

		});
		
		Route::group(['prefix'=>"sale-deed"], function(){
			Route::post('/init',[SaleDeedController::class, 'init']);
			Route::post('/store',[SaleDeedController::class, 'store']);

		});
		
		Route::group(['prefix'=>"bt-transaction"], function(){
			Route::post('/init',[BtTransactionController::class, 'init']);
			Route::post('/store',[BtTransactionController::class, 'store']);

		});
		
	});
	Route::group(['prefix'=>"users"], function(){
		Route::post('/init',[UserController::class, 'initUser']);
		Route::post('/store',[UserController::class, 'storeUser']);

	});

	Route::group(['prefix'=>"attendance"], function(){
		Route::post('/init',[AttendanceController::class, 'init']);
		Route::post('/store',[AttendanceController::class, 'store']);
	});

	Route::group(['prefix'=>"bill-books"], function(){

		Route::group(['prefix'=>"type1"], function(){
			Route::post('/init',[BillBookController::class, 'initType1']);
			Route::post('/store',[BillBookController::class, 'storeType1']);

		});
		
		Route::group(['prefix'=>"type2"], function(){
			Route::post('/init',[BillBookController::class, 'initType2']);
			Route::post('/store',[BillBookController::class, 'storeType2']);

		});
	});
	Route::group(['prefix'=>"day-book"], function(){
		Route::post('/init',[DayBookController::class, 'initRes']);
		Route::post('/store',[DayBookController::class, 'store']);
	});

	Route::group(['prefix'=>"banks"], function(){
		Route::post('/store',[AdminController::class, 'storeBanks']);
	});
});


