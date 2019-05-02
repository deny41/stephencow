<?php

namespace App\Http\Controllers\master;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\product;
use App\log;
use Carbon\carbon;
use Illuminate\Http\Request;

class productController extends Controller
{
 
    public function index()
    {
        $data = product::all();
        return view('master.product.index_product',compact('data'));
    }
    public function create_product()
    {
        $data = DB::table('m_product')->max('mp_id');
        if ($data == null) {
            $data = 1;
        }else{
            $data+=1;
        }
        $data = 'PD-'.date('d').date('y').'-'.str_pad($data,4,"0",STR_PAD_LEFT);

        return view('master.product.create_product',compact('data'));
    }

    public function save_product(Request $req)
    {   

        $check = DB::table('m_product')
                        ->where('mp_code',$req->mp_code)
                        ->first();
        if ($check != null) {
            return response()->json(['status'=>'ada']);
        }

        DB::beginTransaction();
        try {
            $save = new product;
            $save->mp_code = $req->mp_code;
            $save->mp_name = $req->mp_name;
            $save->mp_notes = $req->mp_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = 'INPUT PRODUCT';
            $log->ml_ref = $req->mp_code;
            $log->save();

            DB::commit();
        
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }

    public function edit_product($id)
    {
        
        $data = product::where('mp_code',$id)->first();
        return view('master.product.edit_product',compact('data'));
    }
    public function update_product(Request $req)
    {   
        $check = DB::table('m_product')
                        ->where('mp_code',$req->mp_code)
                        ->first();
        if ($check != null) {
            if ($check->mp_code != $req->mp_code_old) {
                return response()->json(['status'=>'ada']);
            }
        }
        

        DB::beginTransaction();
        try {
            $save = product::find($req->mp_id);
            $save->mp_code = $req->mp_code;
            $save->mp_name = $req->mp_name;
            $save->mp_notes = $req->mp_notes;
            $save->save();
            
            $log = new log;
            $log->ml_operator = auth::user()->username;
            $log->ml_notes = "'UPDATE PRODUCT";
            $log->ml_ref = $req->mp_code;
            $log->save();

            DB::commit();
            return response()->json(['status'=>'sukses']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'gagal']);
        }

    }
    public function delete_product($id)
    {
        $save = product::where('mp_code',$id)->delete();

        $log = new log;
        $log->ml_operator = auth::user()->username;
        $log->ml_notes = "'DELETE PRODUCT";
        $log->ml_ref = $id;
        $log->save();
        
        if ($save == true) {
            return response()->json(['status'=>'sukses']);
        }
    }
}
