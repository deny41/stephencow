<?php

namespace App\Http\Controllers\master;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\user;
use App\log;
use Carbon\carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
 
    public function index()
    {
        $data = user::all();
        if (Auth::user()->privileges == 'master'){
            return view('master.admin.index_admin',compact('data'));
        }else{
            return view('errors.hak_akses_valid');
        }
    }
    public function create_admin()
    {
        
        if (Auth::user()->privileges == 'master'){
            return view('master.admin.create_admin');
        }else{
            return view('errors.hak_akses_valid');
        }
    }

    public function save_admin(Request $req)
    {   
        // dd($req->all());
        $check_user = DB::table('users')
                        ->where('name',$req->name)
                        ->first();
        $check_email = DB::table('users')
                        ->where('email',$req->email)
                        ->first();
        if ($check_user != null) {
            return response()->json(['status'=>'ada user']);
        }else if($check_email != null){
            return response()->json(['status'=>'ada email']);
        }

        DB::beginTransaction();
        try {
            $save = new user;
            $save->name = $req->name;
            $save->username = $req->username;
            $save->email = $req->email;
            $save->privileges = $req->privileges;
            $save->password = Hash::make($req->password);
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = 'INPUT admin';
            $log->ml_ref = $req->name;
            $log->save();

            DB::commit();
        
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }

    public function edit_admin($id)
    {
        
        $data = user::where('id',$id)->first();
        if (Auth::user()->privileges == 'master'){
            return view('master.admin.edit_admin',compact('data'));
        }else{
            return view('errors.hak_akses_valid');
        }
        
    }
    public function update_admin(Request $req)
    {   

        DB::beginTransaction();
        try {
            $save = user::find($req->id);
            $save->name = $req->name;
            $save->email = $req->email;
            $save->privileges = $req->privileges;
            $save->password = Hash::make($req->password);
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = "'UPDATE admin";
            $log->ml_ref = $req->id;
            $log->save();

            DB::commit();
            return response()->json(['status'=>'sukses']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function delete_admin($id)
    {
        $save = user::where('id',$id)->delete();

        $log = new log;
        $log->ml_operator = auth::user()->username;
        $log->ml_notes = "'DELETE admin";
        $log->ml_ref = $id;
        $log->save();
        
        if ($save == true) {
            return response()->json(['status'=>'sukses']);
        }
    }
}
