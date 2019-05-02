<?php

namespace App\Http\Controllers\operational;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\member;
use App\user;
use App\product;
use App\web_regist;
use App\bank;
use App\keterangan_mem;
use App\log;
use Carbon\carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class memberController extends Controller
{
 
    public function index()
    {
        $date = date('Y-m-d');
        $data = DB::select("SELECT * FROM o_member 
                            left join m_keterangan_member on m_keterangan_member.mk_code = o_member.om_keterangan_mem
                            left join m_bank on m_bank.mb_code = o_member.om_bank
                            left join m_web_registration on m_web_registration.mw_code = o_member.om_web_regist
                            left join users on users.id = o_member.om_operator
                            where om_date >= '$date' and om_date <= '$date'
                            ");
        $admin = user::all();
        $product = product::all();
        $member = member::all();
        

        return view('operational.member.index_member',compact('data','seq','admin','product','member'));
    }
    public function datatable_member()
    {
        set_time_limit(30000);
        ini_set('memory_limit', '-1');

        $date = date('Y-m-d');
        // return $date;
        // $date_min7 = date('Y-m-d' , $date_7);;

        $data = DB::select("SELECT * FROM o_member 
                            left join m_keterangan_member on m_keterangan_member.mk_code = o_member.om_keterangan_mem
                            left join m_bank on m_bank.mb_code = o_member.om_bank
                            left join m_web_registration on m_web_registration.mw_code = o_member.om_web_regist
                            left join users on users.id = o_member.om_operator
                            where om_date >= '$date' and om_date <= '$date'
                            ");
        $seq = DB::select("SELECT ot_member as om_cd,sum(ot_sales) sales,sum(ot_purchase) purchase FROM o_transaction group by ot_member");

        if ($seq == null) {
            $seq = 'kosong';
        }
        // return $seq;
        // $data = array_merge($data1,$seq);
        $data = collect($data);
        // return $data;

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                return'<div class="btn-group">
                            <a href="'.$data->om_code .'/edit_member" class="btn btn-sm txt-color-white bg-color-orange"><i class="fa fa-pencil-square-o"></i></a>
                       </div>';
            })
            ->addColumn('sales', function($data) {
                    $seq = DB::select("SELECT ot_member,sum(ot_sales) sales,sum(ot_purchase) purchase FROM o_transaction group by ot_member");
                    for ($i=0; $i <count($seq) ; $i++) { 
                        if ($data->om_code == $seq[$i]->ot_member) {
                            return 'Rp. '.number_format($seq[$i]->sales,0,'','.');
                        }
                    }
                    
            })
            ->addColumn('purchase', function($data) {
                    $seq = DB::select("SELECT ot_member,sum(ot_sales) sales,sum(ot_purchase) purchase FROM o_transaction group by ot_member");
                    for ($i=0; $i <count($seq) ; $i++) { 
                        if ($data->om_code == $seq[$i]->ot_member) {
                            return 'Rp. '.number_format($seq[$i]->purchase,0,'','.');
                        }
                    }
            })
            ->addColumn('detail', function ($data) {
                return'<button onclick="detail(\''.$data->om_code.'\')" type="button" class="btn btn-sm btn-primary btn-xl" data-toggle="modal">
                        <i class="fa fa-fw fa-th"></i>
                       </button>';
            })
            
           
            ->rawColumns(['aksi','sales','purchase','detail'])
            ->addIndexColumn()
            ->make(true);
    }
    public function detail_member(Request $request)
    {
        // dd($request->all());
         $data = DB::select("SELECT * FROM o_member 
                            left join m_keterangan_member on m_keterangan_member.mk_code = o_member.om_keterangan_mem
                            left join m_bank on m_bank.mb_code = o_member.om_bank
                            left join m_web_registration on m_web_registration.mw_code = o_member.om_web_regist
                            left join users on users.id = o_member.om_operator
                            where om_code = '$request->id'
                            ");
         // return $data;
         return response()->json(['status'=>$data]);
    }
    public function create_member()
    {
        $data = DB::table('o_member')->max('om_id');
        if ($data == null) {
            $data = 1;
        }else{
            $data+=1;
        }
        $data = 'OM-'.date('d').date('y').'-'.str_pad($data,4,"0",STR_PAD_LEFT);
        if (Auth::user()->privileges == 'master') {
            $admin = user::all();
        }else{
            $admin = user::all()->where('id',Auth::user()->id);
        }

        $product = product::all();
        $web_regist = web_regist::all();
        $bank = bank::all();
        $keterangan_mem = keterangan_mem::all();

        return view('operational.member.create_member',compact('data','admin','product','web_regist','bank','keterangan_mem'));
    }
    public function save_member(Request $req)
    {   
        $check_code = DB::table('o_member')
                        ->where('om_code',$req->om_code)
                        ->first();
        $check_rek = DB::table('o_member')
                        ->where('om_no_rek',$req->om_no_rek)
                        ->first();
        if ($check_code != null) {
            return response()->json(['status'=>'ada code']);
        }else if($check_rek != null){
            return response()->json(['status'=>'ada rek']);
        }

        DB::beginTransaction();
        try {
            $save = new member;
            $save->om_operator = $req->om_admin;
            $save->om_web_regist = $req->om_web_regist;
            $save->om_product = $req->om_product;
            $save->om_code = $req->om_code;
            $save->om_name = $req->om_name;
            $save->om_phone1 = $req->om_phone1;
            $save->om_phone2 = $req->om_phone2;
            $save->om_bbm = $req->om_bbm;
            $save->om_line = $req->om_line;
            $save->om_email = $req->om_email;
            $save->om_bank = $req->om_bank;
            $save->om_name_rek = $req->om_name_rek;
            $save->om_no_rek = $req->om_no_rek;
            $save->om_no_referal = $req->om_no_referal;
            $save->om_name_referal = $req->om_name_referal;
            $save->om_date = $req->om_date;
            $save->om_keterangan_mem = $req->om_keterangan;
            $save->om_notes = $req->om_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = 'INPUT MEMBER';
            $log->ml_ref = $req->om_code;
            $log->ml_member = $req->om_code;
            $log->save();

            DB::commit();
        
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function edit_member($id)
    {
        $data = member::where('om_code',$id)->first();
        // return $data;
        $admin = user::all();
        $product = product::all();
        $web_regist = web_regist::all();
        $bank = bank::all();
        $keterangan_mem = keterangan_mem::all();
        if (Auth::user()->privileges == 'master') {
            return view('operational.member.edit_member',compact('data','admin','product','web_regist','bank','keterangan_mem'));
        }else{
            return view('errors.hak_akses_valid');
        }   
        
    }
    public function update_member(Request $req)
    {   
        DB::beginTransaction();
        try {
            $save = member::find($req->om_id);
            $save->om_operator = $req->om_admin;
            $save->om_web_regist = $req->om_web_regist;
            $save->om_product = $req->om_product;
            $save->om_code = $req->om_code;
            $save->om_name = $req->om_name;
            $save->om_phone1 = $req->om_phone1;
            $save->om_phone2 = $req->om_phone2;
            $save->om_bbm = $req->om_bbm;
            $save->om_line = $req->om_line;
            $save->om_email = $req->om_email;
            $save->om_bank = $req->om_bank;
            $save->om_name_rek = $req->om_name_rek;
            $save->om_no_rek = $req->om_no_rek;
            $save->om_no_referal = $req->om_no_referal;
            $save->om_name_referal = $req->om_name_referal;
            $save->om_date = $req->om_date;
            $save->om_keterangan_mem = $req->om_keterangan;
            $save->om_notes = $req->om_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = "'UPDATE MEMBER";
            $log->ml_ref = $req->om_code;
            $log->ml_member = $req->om_code;
            $log->save();

            DB::commit();
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function delete_member($id)
    {
        $data = DB::table('o_transaction')->where('ot_member',$id)->get();

        if (count($data) > 0) {
            return response()->json(['status'=>'ada transaksi']);
        }

        $save = member::where('om_code',$id)->delete();

        $log = new log;
        $log->ml_operator = auth::user()->username;
        $log->ml_notes = "'DELETE MEMBER";
        $log->ml_ref = $id;
        // $log->ml_member = $req->om_code;
        $log->save();

        if ($save == true) {
            return response()->json(['status'=>'sukses']);
        }
    }
}
