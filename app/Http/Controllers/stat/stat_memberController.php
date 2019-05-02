<?php

namespace App\Http\Controllers\stat;
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

class stat_memberController extends Controller
{
 
    public function stat_member()
    {
        $admin = user::all();
        $member = member::all();
        $product = product::all();
        return view('stat.stat_member.stat_member',compact('data','admin','product','member'));
    }
    public function search_member(Request $req)
    {

        

        if ($req->om_product != '' || $req->om_product != null) {
            $product = " AND ot_product = '".$req->om_product."' ";
        }else{
            $product = '';
        }
    
        $tgl = DB::select("SELECT ot_date as tgl_tgl FROM o_transaction WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end'  group by ot_date order by ot_date ASC");
        

        $product = DB::select("SELECT ot_date as tgl_prd,count(ot_product) as prd,ot_product FROM o_transaction WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' group by ot_product,ot_date order by ot_date ASC");
        
        // return array_merge([$tgl,$product]);
        // return $product;
        if ($tgl == null) {
            return response()->json(['status'=>'kosong']);
        }else{ 
            return view('stat.stat_member.stat_member_ajax',compact('tgl','product'));
        }
    }
}
