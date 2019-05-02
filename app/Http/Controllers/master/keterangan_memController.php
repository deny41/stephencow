<?php

namespace App\Http\Controllers\master;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\keterangan_mem;
use App\log;
use Carbon\carbon;
use Illuminate\Http\Request;

class keterangan_memController extends Controller
{
 
    public function index()
    {
        $data = keterangan_mem::all();
        return view('master.keterangan_mem.index_keterangan_mem',compact('data'));
    }
    public function create_keterangan_mem()
    {
        $data = DB::table('m_keterangan_member')->max('mk_id');
        if ($data == null) {
            $data = 1;
        }else{
            $data+=1;
        }
        $data = 'KM-'.date('d').date('y').'-'.str_pad($data,4,"0",STR_PAD_LEFT);

        return view('master.keterangan_mem.create_keterangan_mem',compact('data'));
    }
    public function save_keterangan_mem(Request $req)
    {   

        $check = DB::table('m_keterangan_member')
                        ->where('mk_code',$req->mk_code)
                        ->first();
        if ($check != null) {
            return response()->json(['status'=>'ada']);
        }

        DB::beginTransaction();
        try {
            $save = new keterangan_mem;
            $save->mk_code = $req->mk_code;
            $save->mk_desc = $req->mk_desc;
            $save->mk_notes = $req->mk_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = 'INPUT KETERANGAN MEMBER';
            $log->ml_ref = $req->mk_code;
            $log->save();

            DB::commit();
        
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function edit_keterangan_mem($id)
    {
        
        $data = keterangan_mem::where('mk_code',$id)->first();
        return view('master.keterangan_mem.edit_keterangan_mem',compact('data'));
    }
    public function update_keterangan_mem(Request $req)
    {   
        $check = DB::table('m_keterangan_member')
                        ->where('mk_code',$req->mk_code)
                        ->first();

        if ($check != null) {
            if ($check->mk_code != $req->mk_code_old) {
                return response()->json(['status'=>'ada']);
            }
        }
        DB::beginTransaction();

        try {
            $save = keterangan_mem::find($req->mk_id);
            $save->mk_code = $req->mk_code;
            $save->mk_desc = $req->mk_desc;
            $save->mk_notes = $req->mk_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = "'UPDATE KETERANGAN MEMBER";
            $log->ml_ref = $req->mk_code;
            $log->save();

            DB::commit();
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function delete_keterangan_mem($id)
    {
        $save = keterangan_mem::where('mk_code',$id)->delete();

        $log = new log;
        $log->ml_operator = auth::user()->username;
        $log->ml_notes = "'DELETE KETERANGAN MEMBER";
        $log->ml_ref = $id;
        $log->save();

        if ($save == true) {
            return response()->json(['status'=>'sukses']);
        }
    }
}
