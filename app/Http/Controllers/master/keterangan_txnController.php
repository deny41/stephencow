<?php

namespace App\Http\Controllers\master;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\log;
use App\keterangan_txn;
use Carbon\carbon;
use Illuminate\Http\Request;

class keterangan_txnController extends Controller
{
 
    public function index()
    {
        $data = keterangan_txn::all();
        return view('master.keterangan_txn.index_keterangan_txn',compact('data'));
    }
    public function create_keterangan_txn()
    {
        $data = DB::table('m_keterangan_txn')->max('mt_id');
        if ($data == null) {
            $data = 1;
        }else{
            $data+=1;
        }
        $data = 'KT-'.date('d').date('y').'-'.str_pad($data,4,"0",STR_PAD_LEFT);

        return view('master.keterangan_txn.create_keterangan_txn',compact('data'));
    }
    public function save_keterangan_txn(Request $req)
    {   

        $check = DB::table('m_keterangan_txn')
                        ->where('mt_code',$req->mt_code)
                        ->first();
        if ($check != null) {
            return response()->json(['status'=>'ada']);
        }
        
        DB::beginTransaction();
        try {
            $save = new keterangan_txn;
            $save->mt_code = $req->mt_code;
            $save->mt_desc = $req->mt_desc;
            $save->mt_notes = $req->mt_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = 'INPUT KETERANGAN TXN';
            $log->ml_ref = $req->mt_code;
            $log->save();

            DB::commit();
        
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function edit_keterangan_txn($id)
    {
        
        $data = keterangan_txn::where('mt_code',$id)->first();
        return view('master.keterangan_txn.edit_keterangan_txn',compact('data'));
    }
    public function update_keterangan_txn(Request $req)
    {   
        DB::beginTransaction();

        try {
            $save = keterangan_txn::find($req->mt_id);
            $save->mt_desc = $req->mt_desc;
            $save->mt_notes = $req->mt_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = "'UPDATE KETERANGAN TXN";
            $log->ml_ref = $req->mt_code;
            $log->save();

            DB::commit();
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function delete_keterangan_txn($id)
    {
        $save = keterangan_txn::where('mt_code',$id)->delete();

        $log = new log;
        $log->ml_operator = auth::user()->username;
        $log->ml_notes = "'DELETE KETERANGAN TXN";
        $log->ml_ref = $id;
        $log->save();

        if ($save == true) {
            return response()->json(['status'=>'sukses']);
        }
    }
}
