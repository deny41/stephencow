<?php

namespace App\Http\Controllers\master;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\web_regist;
use App\log;
use Carbon\carbon;
use Illuminate\Http\Request;

class web_registController extends Controller
{
 
    public function index()
    {
        $data = web_regist::all();
        return view('master.web_regist.index_web_regist',compact('data'));
    }
    public function create_web_regist()
    {
        $data = DB::table('m_web_registration')->max('mw_id');
        if ($data == null) {
            $data = 1;
        }else{
            $data+=1;
        }
        $data = 'MW-'.date('d').date('y').'-'.str_pad($data,4,"0",STR_PAD_LEFT);

        return view('master.web_regist.create_web_regist',compact('data'));
    }
    public function save_web_regist(Request $req)
    {   
        $check = DB::table('m_web_registration')
                        ->where('mw_code',$req->mw_code)
                        ->first();
        if ($check != null) {
            return response()->json(['status'=>'ada']);
        }

        // dd($req->all());
        DB::beginTransaction();

        try {
            $save = new web_regist;
            $save->mw_code = $req->mw_code;
            $save->mw_name = $req->mw_name;
            $save->mw_notes = $req->mw_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = 'INPUT WEB REGISTRATION';
            $log->ml_ref = $req->mw_code;
            $log->save();

            DB::commit();
        
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function edit_web_regist($id)
    {
        
        $data = web_regist::where('mw_code',$id)->first();
        return view('master.web_regist.edit_web_regist',compact('data'));
    }
    public function update_web_regist(Request $req)
    {   

        $check = DB::table('m_web_registration')
                        ->where('mw_code',$req->mw_code)
                        ->first();

        if ($check != null) {
            if ($check->mw_code != $req->mw_code_old) {
                return response()->json(['status'=>'ada']);
            }
        }
        DB::beginTransaction();

        try {
            $save = web_regist::find($req->mw_id);
            $save->mw_code = $req->mw_code;
            $save->mw_name = $req->mw_name;
            $save->mw_notes = $req->mw_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = "'UPDATE WEB REGISTRATION";
            $log->ml_ref = $req->mw_code;
            $log->save();

            DB::commit();
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function delete_web_regist($id)
    {
        $save = web_regist::where('mw_code',$id)->delete();

        $log = new log;
        $log->ml_operator = auth::user()->username;
        $log->ml_notes = "'DELETE WEB REGISTRATION";
        $log->ml_ref = $id;
        $log->save();
        if ($save == true ) {
            return response()->json(['status'=>'sukses']);
        }
    }
}
