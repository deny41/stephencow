<?php

namespace App\Http\Controllers\stat;
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
use Illuminate\Http\Request;

class stat_transactionController extends Controller
{
 
    public function stat_transaction()
    {
        // $data = DB::table('o_transaction')
        //                     ->leftjoin('o_member','o_member.om_code','=','o_transaction.ot_member')
        //                     ->leftjoin('users','users.id','=','o_transaction.ot_operator')
        //                     ->leftjoin('m_keterangan_txn','m_keterangan_txn.mt_code','=','o_transaction.ot_keterangan_txn')
        //                     ->get();
        $date = date('Y/m/d');

        $data = DB::select("SELECT ot_date ,SUM(ot_purchase) as  sales_purchase ,SUM(ot_sales) as sales_total FROM o_transaction 
                            WHERE ot_date BETWEEN '$date' AND '$date'
                            group by ot_date
                            ");


        $admin = user::all();
        $member = member::all();
        $product = product::all();
        return view('stat.stat_transaction.stat_transaction',compact('data','admin','member','product'));
    }
    public function search_transaction(Request $req)
    {
        // dd($req->all());
        if ($req->om_product != '' || $req->om_product != null) {
            $product = " AND ot_product = '".$req->om_product."' ";
        }else{
            $product = '';
        }
        
        if ($req->pembelian == 'on' || $req->pembelian == 'on') {
            $pembelian = ",SUM(ot_purchase) as  sales_purchase";
        }else{
            $pembelian = '';
        }

        if ($req->penjualan == 'on' || $req->penjualan == 'on') {
            $penjualan = " ,SUM(ot_sales) as sales_total ";
        }else{
            $penjualan = '';
        }

        $data = DB::select("SELECT ot_date $pembelian $penjualan FROM o_transaction 
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $product
                            group by ot_date
                            ");
        // return $data;
        if ($data == null) {
            return response()->json(['status'=>'kosong']);
        }else{
            return view('stat.stat_transaction.stat_transaction_ajax',compact('data'));
        }
    }

    public function search_month_transaction(Request $req)
    {
        # code...
    }

    
}
