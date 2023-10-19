<?php

namespace App\Models;

use DB, Session, Cache;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\MailQueue;

class User extends Authenticatable {

    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    //protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getBanks(){

        $banks = DB::table('banks')->where('status', 0)->get();

        return $banks;

    }
    
    public static function getYears(){

        $years = DB::table('year_search')->where('status', 0)->get();

        return $years;

    }
    
    public static function getThrough(){

        $through = DB::table('through')->where('status',0)->get();

        return $through;

    }
    public static function getDocumentTypes(){

        $document_types = DB::table('document_types')->get();

        return $document_types;

    }
    
    public static function getBillingTypes(){

        $billing_types = DB::table('billing_types')->where('status',0)->get();

        return $billing_types;

    }
    
    public static function getDraftTypes(){

        $drafting_types = DB::table('drafting_types')->get();

        return $drafting_types;

    }
    
    public static function getTehsil(){

        $tehsils = DB::table('tehsil')->where('status', 0)->get();

        return $tehsils;

    }
    
    public static function getVillages(){

        $tehsils = DB::table('villages')->where('status', 0)->get();

        return $tehsils;

    }
    
    public static function getDays(){

        $days = DB::table('days')->where('status',0)->orderBy('day', 'ASC')->get();

        return $days;

    }
    
    public static function getOpinion(){

        $sql = DB::table('legal_opinion')
        ->select('legal_opinion.*', 'year_search.ys_name', 'banks.bank_name', 'through.through_type', 'billing_types.bill_type', 'days.day')
        ->leftJoin('year_search', 'year_search.id', '=', 'legal_opinion.year_search_id')
        ->leftJoin('banks','banks.id','=','legal_opinion.bank_comp_id')
        ->leftJoin('through','through.id','=','legal_opinion.through_id')
        ->leftJoin('billing_types','billing_types.id','=','legal_opinion.billing_type_id')
        ->leftJoin('days','days.id','=','legal_opinion.tat');

        return $sql;

    }
    
    public static function getAgriFin(){

        $agriFinSql = DB::table('agricultural_finance')
        ->select('agricultural_finance.*', 'year_search.ys_name', 'banks.bank_name', 'through.through_type', 'billing_types.bill_type')
        ->leftJoin('year_search', 'year_search.id', '=', 'agricultural_finance.year_search_id')
        ->leftJoin('banks','banks.id','=','agricultural_finance.bank_comp_id')
        ->leftJoin('through','through.id','=','agricultural_finance.through_id')
        ->leftJoin('billing_types','billing_types.id','=','agricultural_finance.billing_type_id');

        return $agriFinSql;

    }    
    
    public static function getDrafting(){

        $sql = DB::table('draftings')
        ->select('draftings.*', 'drafting_types.draft_type', 'through.through_type', 'billing_types.bill_type')
        ->leftJoin('drafting_types','drafting_types.id','=','draftings.drafting_type_id')
        ->leftJoin('through','through.id','=','draftings.through_id')
        ->leftJoin('billing_types','billing_types.id','=','draftings.billing_type_id');

        return $sql;

    }
    
    public static function getMutations(){

        $sql = DB::table('mutations')
        ->select('mutations.*', 'tehsil.tehsil_name', 'villages.village_name')
        ->leftJoin('tehsil', 'tehsil.id', '=', 'mutations.tehsil_id')
        ->leftJoin('villages', 'villages.id', '=', 'mutations.village_id');   

        return $sql;

    }
    
    public static function getTempBills(){

        $sql = DB::table('temp_bills')
        ->select('temp_bills.*', 'banks.bank_name')
        ->leftJoin('banks', 'banks.id', '=', 'temp_bills.bank_id');

        return $sql;

    }
    
    public static function getBillBooks(){

        $sql = DB::table('bill_books')
        ->select('bill_books.*', 'banks.bank_name')
        ->leftJoin('banks', 'banks.id', '=', 'bill_books.bank_comp_id');

        return $sql;

    }

    public static function statusList(){
        $ar = [];
        $ar[] = ['value'=>1,'label'=>'Ready'];
        $ar[] = ['value'=>2,'label'=>'Under Process'];
        $ar[] = ['value'=>3,'label'=>'Defected / Rejected'];

        return $ar;
    }

    public static function showStatusList(){
        return [1=>'Ready',2=>"Under Process",3=>"Defected / Rejected"];
    }
    
    public static function statusList2(){
        $ar = [];
        $ar[] = ['value'=>1,'label'=>'Collected '];
        $ar[] = ['value'=>2,'label'=>'Pending '];
        $ar[] = ['value'=>3,'label'=>'In Defect'];
        $ar[] = ['value'=>4,'label'=>'Submitted /Handover'];

        return $ar;
    }
    
    public static function SROList(){
        $ar = [];
        $ar[] = ['value'=>1,'label'=>'SRO 1'];
        $ar[] = ['value'=>2,'label'=>'SRO 2'];
        $ar[] = ['value'=>3,'label'=>'SRO 3'];

        return $ar;
    }

    public static function GetSROByKey(){
        return array (1 => 'SRO 1',2 => 'SRO 2',3 => 'SRO 3');
    }

    public static function addDays($name){
    
        $day_id = DB::table('days')->insertGetId([
            'day'=>$name,
            'created_at'=>date('Y-m-d H:i:s'),
            'status' => 1,
        ]);

        return $day_id;
    }
    
    public static function addTehsil($name){
    
        $tehsil_id = DB::table('tehsil')->insertGetId([
            'tehsil_name'=>$name,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        return $tehsil_id;
    }

    public static function addThrough($name){
    
        $through_id = DB::table('through')->insertGetId([
            'through_type'=>$name,
            'status' => 1,
            // 'created_at'=>date('Y-m-d H:i:s'),
        ]);

        return $through_id;
    }

    public static function addVillage($name){
    
        $village_id = DB::table('villages')->insertGetId([
            'village_name'=>$name,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        return $village_id;
    }

    public static function addDocumentType($name){
    
        $document_type_id = DB::table('document_types')->insertGetId([
            'type'=>$name,
            
        ]);

        return $document_type_id;
    }

    public static function addBilling($name){
    
        $billing_type_id = DB::table('billing_types')->insertGetId([
            'bill_type'=>$name,
            'status' => 1,
        ]);

        return $billing_type_id;
    }

    public static function addDraft($name){
    
        $drafting_type_id = DB::table('drafting_types')->insertGetId([
            'draft_type'=>$name,
            
        ]);

        return $drafting_type_id;
    }

    // public static function bgColor($status){
    //     $bgColor = '#fff';
    //     switch ($status) {
    //         case 1:
    //             $bgColor = '#00FF00';
    //             break;

    //         case 2:
    //             $bgColor = '#0000FF';
    //             break;

    //         case 3:
    //             $bgColor = '#FF0000';
    //             break;
    //         case 0:
    //             $bgColor = '#FFFFFF';
    //             break;

    //         default:
    //             $bgColor = '#FFF';
    //             break;
    //     }

    //     return $bgColor;
    // }

    public static function bgClass($status){
        $bgClass = '';
        switch ($status) {
            case 1:
                $bgClass = 'green';
                break;

            case 2:
                $bgClass = 'blue';
                break;

            case 3:
                $bgClass = 'red';
                break;
            case 0:
                $bgClass = 'white';
                break;

            default:
                $bgClass = 'white';
                break;
        }

        return $bgClass;
    }

    public static function bgClass1($status){
        $bgClass = '';
        switch ($status) {
            case 1:
                $bgClass = 'green';
                break;

            case 2:
                $bgClass = 'red';
                break;

            case 3:
                $bgClass = 'blue';
                break;
            default:
                $bgClass = 'white';
                break;
        }

        return $bgClass;
    }

    // $ar[] = ['value'=>1,'label'=>'Collected '];
    //     $ar[] = ['value'=>2,'label'=>'Pending '];
    //     $ar[] = ['value'=>3,'label'=>'In Defect'];
    //     $ar[] = ['value'=>4,'label'=>'Submitted /Handover'];

    public static function bgClass2($status){
        $bgClass = '';
        switch ($status) {
            case 1:
                $bgClass = 'yellow';
                break;

            case 2:
                $bgClass = 'blue';
                break;

            case 3:
                $bgClass = 'red';
                break;

            case 4:
                $bgClass = 'green';
                break;
            case 0:
                $bgClass = 'white';
                break;
            default:
                $bgClass = 'white';
                break;
        }

        return $bgClass;
    }
    public static function filePdfExtensions(){
        return array (
            "pdf","PDF","JPG",'jpg'
        );
    }
    public static function getFileName($name, $extension){
        $name = str_replace(' ', '_', $name);
        $name = preg_replace('/[^A-Za-z0-9_\.\-]/', '', $name);
        $name_ex = explode('.', $name);
        $filename = "";
        foreach($name_ex as $index => $n){
            if($index <= sizeof($name_ex) - 2){
                $filename .= $n;
            }
        }

        $filename = $filename."_".strtotime("now").".".$extension;

        return $filename;
    }
    
}
