<?php

namespace App\Http\Controllers\report;
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
use Excel;
use Yajra\Datatables\Datatables;

class rep_transactionController extends Controller
{
 
    public function rep_transaction()
    {
        $data = DB::table('o_transaction')
                            ->leftjoin('o_member','o_member.om_code','=','o_transaction.ot_member')
                            ->leftjoin('users','users.id','=','o_transaction.ot_operator')
                            ->leftjoin('m_keterangan_txn','m_keterangan_txn.mt_code','=','o_transaction.ot_keterangan_txn')
                            ->get();


        $admin = user::all();
        $member = member::all();
        $product = product::all();


        return view('report.rep_transaction.rep_transaction',compact('data','admin','member','product'));
    }
    public function search_transaction(Request $req)
    {
        // dd($req->all());
        $date_first = $req->date_first;
        $date_end = $req->date_end;
        $admin   =$req->admin;
        $product    =$req->product;
        $member =$req->member;

        if ($req->om_admin != '' || $req->om_admin != null) {
            $admin = " AND ot_operator = '".$req->om_admin."' ";
        }else{
            $admin = '';
        }

        if ($req->om_product != '' || $req->om_product != null) {
            $product = " AND ot_product = '".$req->om_product."' ";
        }else{
            $product = '';
        }

        if ($req->ot_member != '' || $req->ot_member != null) {
            $member = " AND ot_member = '".$req->ot_member."' ";
        }else{
            $member = '';
        }

        // return $req->date_end;

        $data = DB::select("SELECT * FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member");
        // return $data;
        $sales_awal = [];
        $purchase_awal = [];
        for ($i=0; $i <count($data) ; $i++) { 
            $sales_awal[$i] = $data[$i]->ot_sales;
            $purchase_awal[$i] = $data[$i]->ot_purchase;
        }
        $sales =  array_sum($sales_awal);
        $purchase =  array_sum($purchase_awal);
        if ($data == null) {
            return response()->json(['status'=>'kosong']);
        }else{
            return view('report.rep_transaction.rep_transaction_ajax',compact('sales','purchase','date_first','date_end','admin','product','member','data'));
        }


    }
    public function hasil_datatable_transaction(Request $req)
    {
        set_time_limit(30000);
        ini_set('memory_limit', '-1');
        // dd($req->all());
        if ($req->om_admin != '' || $req->om_admin != null) {
            $admin = " AND ot_operator = '".$req->om_admin."' ";
        }else{
            $admin = '';
        }

        if ($req->om_product != '' || $req->om_product != null) {
            $product = " AND ot_product = '".$req->om_product."' ";
        }else{
            $product = '';
        }

        if ($req->ot_member != '' || $req->ot_member != null) {
            $member = " AND ot_member = '".$req->ot_member."' ";
        }else{
            $member = '';
        }

        $data = DB::select("SELECT * FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member");
        
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
    public function pdf_transaction (Request $req)
    {
        // dd($req->all());
        if ($req->om_admin != '' || $req->om_admin != null) {
            $admin = " AND ot_operator = '".$req->om_admin."' ";
        }else{
            $admin = '';
        }

        if ($req->om_product != '' || $req->om_product != null) {
            $product = " AND ot_product = '".$req->om_product."' ";
        }else{
            $product = '';
        }

        if ($req->ot_member != '' || $req->ot_member != null) {
            $member = " AND ot_member = '".$req->ot_member."' ";
        }else{
            $member = '';
        }

        // return $req->date_end;

        $data = DB::select("SELECT * FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member");

        $sales_awal = 0; 
        $purchase_awal = 0; 
        for ($i=0; $i <count($data) ; $i++) { 
            $sales_awal += $data[$i]->ot_sales;
            $purchase_awal += $data[$i]->ot_purchase;
        }
        
        if ($data == null) {
            return response()->json(['status'=>'kosong']);
        }else{
            return view('report.rep_transaction.rep_transaction_pdf',compact('data','sales_awal','purchase_awal'));
        }
    }

    public function excel_transaction (Request $req)
    {

        // dd($req->all());

        if ($req->om_admin != '' || $req->om_admin != null) {
            $admin = " AND ot_operator = '".$req->om_admin."' ";
        }else{
            $admin = '';
        }

        if ($req->om_product != '' || $req->om_product != null) {
            $product = " AND ot_product = '".$req->om_product."' ";
        }else{
            $product = '';
        }

        if ($req->ot_member != '' || $req->ot_member != null) {
            $member = " AND ot_member = '".$req->ot_member."' ";
        }else{
            $member = '';
        }

        // return $req->date_end;

        $data = DB::select("SELECT * FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member");
        $sales_awal = 0; 
        $purchase_awal = 0; 
        for ($i=0; $i <count($data) ; $i++) { 
            $sales_awal += $data[$i]->ot_sales;
            $purchase_awal += $data[$i]->ot_purchase;
        }
        
        if ($data == null) {
            return response()->json(['status'=>'kosong']);
        }else{
        
        // return view('report.rep_transaction.rep_transaction_excel',compact('data','sales_awal','purchase_awal'));
        
        Excel::create('Transaction '.date('d-m-y'), function($excel) use ($data,$sales_awal,$purchase_awal){
            $excel->sheet('New sheet', function($sheet) use ($data,$sales_awal,$purchase_awal) {
                $sheet->loadView('report.rep_transaction.rep_transaction_excel')
                ->with('data',$data)
                ->with('sales_awal',$sales_awal)
                ->with('purchase_awal',$purchase_awal);
            });

        })->download('csv');

        }
    }

}
