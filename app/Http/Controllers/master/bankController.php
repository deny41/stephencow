<?php

namespace App\Http\Controllers\master;
use App\Http\Controllers\Controller;
use DB;
use auth;
use Carbon\carbon;
use App\bank;
use App\log;
use Illuminate\Http\Request;

class bankController extends Controller
{
 
    public function index()
    {
        $data = bank::all();
        return view('master.bank.index_bank',compact('data'));
    }
    public function create_bank()
    {
        $data = DB::table('m_bank')->max('mb_id');
        if ($data == null) {
            $data = 1;
        }else{
            $data+=1;
        }
        $data = 'BK-'.date('d').date('y').'-'.str_pad($data,4,"0",STR_PAD_LEFT);

        return view('master.bank.create_bank',compact('data'));
    }
    public function save_bank(Request $req)
    {   
        $check = DB::table('m_bank')
                        ->where('mb_code',$req->mb_code)
                        ->first();
        if ($check != null) {
            return response()->json(['status'=>'ada']);
        }
        
        DB::beginTransaction();
        try {
            $save = new bank;
            $save->mb_code = $req->mb_code;
            $save->mb_name = $req->mb_name;
            $save->mb_notes = $req->mb_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = 'INPUT BANK';
            $log->ml_ref = $req->mb_code;
            $log->save();

            DB::commit();
        
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function edit_bank($id)
    {
        $data = bank::where('mb_code',$id)->first();
        return view('master.bank.edit_bank',compact('data'));
    }
    public function update_bank(Request $req)
    {   

        $check = DB::table('m_bank')
                        ->where('mb_code',$req->mb_code)
                        ->first();

        if ($check != null) {
            if ($check->mb_code != $req->mb_code_old) {
                return response()->json(['status'=>'ada']);
            }
        }

        DB::beginTransaction();
        try {
            $save = bank::find($req->mb_id);
            $save->mb_code = $req->mb_code;
            $save->mb_name = $req->mb_name;
            $save->mb_notes = $req->mb_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = "'UPDATE BANK";
            $log->ml_ref = $req->mb_code;
            $log->save();

            DB::commit();
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function delete_bank($id)
    {
        $save = bank::where('mb_code',$id)->delete();

        $log = new log;
        $log->ml_operator = auth::user()->username;
        $log->ml_notes = "'DELETE BANK";
        $log->ml_ref = $id;
        $log->save();

        if ($save == true) {
            return response()->json(['status'=>'sukses']);
        }
    }
}
