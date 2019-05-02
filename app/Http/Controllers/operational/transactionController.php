<?php

namespace App\Http\Controllers\operational;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\transaction;
use App\user;
use App\product;
use App\web_regist;
use App\bank;
use App\keterangan_mem;
use App\keterangan_txn;
use App\log;
use App\member;
use Carbon\carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class transactionController extends Controller
{
 
    public function index()
    {
 
        $admin = user::all();
        $member = member::all();
        $product = product::all();


        return view('operational.transaction.index_transaction',compact('admin','member','product'));
    }
    public function datatable_transaction()
    {
        set_time_limit(30000);
        ini_set('memory_limit', '-1');

        $date = date('Y-m-d');
        $data = DB::table('o_transaction')
                            ->leftjoin('o_member','o_member.om_code','=','o_transaction.ot_member')
                            ->leftjoin('users','users.id','=','o_transaction.ot_operator')
                            ->leftjoin('m_keterangan_txn','m_keterangan_txn.mt_code','=','o_transaction.ot_keterangan_txn')
                            ->where('ot_date','>=',$date)
                            ->where('ot_date','<=',$date)
                            ->orderBy('ot_date','DESC')
                            ->get();
        
        $data = collect($data);

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                return'<div class="btn-group">
                              <a href="'.$data->ot_code.'/edit_transaction" class="btn btn-sm txt-color-white bg-color-orange"><i class="fa fa-pencil-square-o"></i></a>
                              <button type="button" class="btn btn-sm btn-danger" onclick="confirmation(\''.$data->ot_code.'\')">
                            <i class="fa fa-eraser"></i>
                           </button>
                        </div>';
            })
            ->addColumn('promo', function ($data) {
                if ($data->ot_nominal_promo == null) {
                    $var = 0;
                }else{
                    $var = $data->ot_nominal_promo;
                }
                return $var;
            })
           
            ->rawColumns(['aksi','promo'])
            ->addIndexColumn()
            ->make(true);
    }
    public function code_transaction (Request $req)
    {
        $date = str_replace('-', '',$req->date);
        $date_now = date('Y-m-d',strtotime($req->date));

        $data = DB::table('o_transaction')
                ->where('ot_date',$date_now)->get();

        if (count($data) == 0) {
            $kode = '00001';
        }else{
            $kode = substr_replace('00000', count($data)+1, -strlen(count($data)));
        }
        $data = 'TX-'.$date.'-'.$kode;
        return response()->json(['status'=>$data]);
    }
    public function create_transaction()
    {
        $date = date('Y-m-d');
        $data = DB::table('o_transaction')->where('ot_date',$date)->get();

        if (count($data) == 0) {
            $kode = '00001';
        }else{
            $kode = substr_replace('00000', count($data)+1, -strlen(count($data)));
        }
        $data = 'TX-'.date('d').date('m').date('Y').'-'.$kode;

        if (Auth::user()->privileges == 'master') {
            $admin = user::all();
        }else{
            $admin = user::all()->where('id',Auth::user()->id);
        }
        $member = member::all();
        $product = product::all();
        $web_regist = web_regist::all();
        $bank = bank::all();
        $keterangan_txn = keterangan_txn::all();
        $keterangan_mem = keterangan_mem::all();

        return view('operational.transaction.create_transaction',compact('data','admin','product','web_regist','bank','keterangan_mem','keterangan_txn','member'));
    }
    public function save_transaction(Request $req)
    {   
        // dd(date('Y-m-d',strtotime($req->ot_date)));

        $fc = str_replace('.', '', $req->ot_first_credit);
        $sales = str_replace('.', '', $req->ot_sales);
        $purchase = str_replace('.', '', $req->ot_purchase);
        $lc = str_replace('.', '', $req->ot_last_credit);
        $ot_nominal_promo = str_replace('.', '', $req->ot_nominal_promo);


        $data = DB::table('o_transaction')->where('ot_code',$req->ot_code)->get();

        $cd = DB::table('o_transaction')->max('ot_id');
        if (count($data) > 0 ) {
            if ($cd == null) {
                $cd = 1;
            }else{
                $cd+=1;
            }
            $code = 'TX-'.date('d').date('m').date('Y').'-'.str_pad($cd,4,"0",STR_PAD_LEFT);
            DB::beginTransaction();
            try {    
                $save = new transaction;
                $save->ot_code           = $code;
                $save->ot_operator       = $req->ot_admin;
                $save->ot_member         = $req->ot_member;
                $save->ot_product        = $req->ot_product;
                $save->ot_sales          = $sales;
                $save->ot_purchase       = $purchase;
                $save->ot_first_credit   = $fc;
                $save->ot_last_credit    = $lc;
                $save->ot_keterangan_txn = $req->ot_keterangan_txn;
                $save->ot_nominal_promo  = $ot_nominal_promo;
                $save->ot_notes          = $req->ot_notes;
                $save->ot_date           = date('Y-m-d',strtotime($req->ot_date));
                $save->save();
                
                $log = new log;
                $log->ml_operator = auth::user()->username;
                $log->ml_notes = 'INPUT TRANSACTION';
                $log->ml_ref = $req->ot_code;
                $log->ml_member = $req->ot_member;
                $log->ml_transaction = $req->ot_name;
                $log->save();

                DB::commit();
            
                return response()->json(['status'=>'ada']);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status'=>'gagal']);
            }
        }else{
            $code = $req->ot_code;
            DB::beginTransaction();
            try {    
                $save = new transaction;
                $save->ot_code           = $code;
                $save->ot_operator       = $req->ot_admin;
                $save->ot_member         = $req->ot_member;
                $save->ot_product        = $req->ot_product;
                $save->ot_sales          = $sales;
                $save->ot_purchase       = $purchase;
                $save->ot_first_credit   = $fc;
                $save->ot_last_credit    = $lc;
                $save->ot_keterangan_txn = $req->ot_keterangan_txn;
                $save->ot_nominal_promo  = $ot_nominal_promo;
                $save->ot_notes          = $req->ot_notes;
                $save->ot_date           = date('Y-m-d',strtotime($req->ot_date));
                $save->save();
                
                $log = new log;
                $log->ml_operator = auth::user()->username;
                $log->ml_notes = 'INPUT TRANSACTION';
                $log->ml_ref = $req->ot_code;
                $log->ml_member = $req->ot_member;
                $log->ml_transaction = $req->ot_name;
                $log->save();

                DB::commit();
            
                return response()->json(['status'=>'sukses']);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status'=>'gagal']);
            }
        }
    }
    

        public function edit_transaction($id)
        {
            
            $data = DB::table('o_transaction')
                                ->leftjoin('o_member','o_member.om_code','=','o_transaction.ot_member')
                                ->leftjoin('users','users.id','=','o_transaction.ot_operator')
                                ->leftjoin('m_keterangan_txn','m_keterangan_txn.mt_code','=','o_transaction.ot_keterangan_txn')
                                ->where('ot_code',$id)
                                ->first();

            // return json_encode( );
                                

            $admin = user::all();
            $member = member::all();
            $product = product::all();
            $web_regist = web_regist::all();
            $bank = bank::all();
            $keterangan_txn = keterangan_txn::all();
            $keterangan_mem = keterangan_mem::all();
            if (Auth::user()->privileges == 'master') {
                return view('operational.transaction.edit_transaction',compact('data','admin','product','web_regist','bank','keterangan_mem','keterangan_txn','member'));
            }else if (Auth::user()->id == $data->id && $data->ot_status != 'CLOSE'){
                return view('operational.transaction.edit_transaction',compact('data','admin','product','web_regist','bank','keterangan_mem','keterangan_txn','member'));
            }else{
                return view('errors.hak_akses_valid');
            }
        }
        public function update_transaction(Request $req)
        {   

            $fc = str_replace('.', '', $req->ot_first_credit);
            $sales = str_replace('.', '', $req->ot_sales);
            $purchase = str_replace('.', '', $req->ot_purchase);
            $lc = str_replace('.', '', $req->ot_last_credit);
            $ot_nominal_promo = str_replace('.', '', $req->ot_nominal_promo);

            DB::beginTransaction();
            try {
                $save = transaction::find($req->ot_id);
                $save->ot_code           = $req->ot_code;
                $save->ot_operator       = $req->ot_admin;
                $save->ot_member         = $req->ot_member;
                $save->ot_product        = $req->ot_product;
                $save->ot_sales          = $sales;
                $save->ot_purchase       = $purchase;
                $save->ot_first_credit   = $fc;
                $save->ot_last_credit    = $lc;
                $save->ot_keterangan_txn = $req->ot_keterangan_txn;
                $save->ot_nominal_promo  = $ot_nominal_promo;
                $save->ot_notes          = $req->ot_notes;
                $save->ot_date           = date('Y-m-d',strtotime($req->ot_date));
                $save->save();
                
                $log = new log;
                $log->ml_operator = auth::user()->username;
                $log->ml_notes = 'INPUT TRANSACTION';
                $log->ml_ref = $req->ot_code;
                $log->ml_member = $req->ot_member;
                $log->ml_transaction = $req->ot_name;
                $log->save();

                DB::commit();
                return response()->json(['status'=>'sukses']);

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['status'=>'gagal']);
            }

        }
        
        public function delete_transaction($id)
        {

                $save = transaction::where('ot_code',$id)->delete();

                $log = new log;
                $log->ml_operator = auth::user()->username;
                $log->ml_notes = "'DELETE TRANSACTION";
                $log->ml_ref = $id;
                // $log->ml_transaction = $req->ot_name;
                $log->save();

                if ($save == true ) {
                    return response()->json(['status'=>'sukses']);
                }
                return view('errors.hak_akses_valid');
        }

    

}
