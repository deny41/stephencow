<?php

namespace App\Http\Controllers\report;
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
use Excel;
use Yajra\Datatables\Datatables;
        
class rep_memberController extends Controller
{
 
    public function rep_member()
    {

        // $data = DB::select("SELECT
        //                     om_code,om_name,SUM(ot_sales) as sales,SUM(ot_purchase) as purchase,ot_operator,om_created_at
        //                     FROM o_transaction 
        //                     LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
        //                     LEFT JOIN users on users.id = o_transaction.ot_operator
        //                     LEFT JOIN m_product on m_product.mp_code = o_transaction.ot_product
        //                     LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
        //                     -- where 
        //                     group by om_code,om_name,mp_name,ot_operator,om_created_at"); 

        $data = DB::select('SELECT * FROM o_member 
                            left join m_keterangan_member on m_keterangan_member.mk_code = o_member.om_keterangan_mem
                            left join m_bank on m_bank.mb_code = o_member.om_bank
                            left join m_web_registration on m_web_registration.mw_code = o_member.om_web_regist
                            left join users on users.id = o_member.om_operator
                            ');
        // return $data;
        $seq = DB::select("SELECT ot_member,sum(ot_sales) sales,sum(ot_purchase) purchase FROM o_transaction group by ot_member");

        // return $data;   
        $admin = user::all();
        $product = product::all();
        $member = member::all();
        return view('report.rep_member.rep_member',compact('data','admin','product','member','seq'));
    }
    public function search_member(Request $req)
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

        $data = DB::select("SELECT 
                            om_code,om_name,SUM(ot_sales) as sales,SUM(ot_purchase) as purchase
                            FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_product on m_product.mp_code = o_transaction.ot_product
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member
                            group by om_code,om_name");
       
        // return $data;
        $sales_awal = 0; 
        $purchase_awal = 0; 
        for ($i=0; $i <count($data) ; $i++) { 
            $sales_awal += $data[$i]->sales;
            $purchase_awal += $data[$i]->purchase;
        }


        // return [$sales_awal,$purchase_awal];
        if ($data == null) {
            return response()->json(['status'=>'kosong']);
        }else{
            return view('report.rep_member.rep_member_ajax',compact('date_first','date_end','admin','product','member','data','sales_awal','purchase_awal'));
        }

    }
    public function hasil_datatable_member(Request $req)
    {
        set_time_limit(30000);
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

        $data = DB::select("SELECT 
                            om_code,om_name,SUM(ot_sales) as sales,SUM(ot_purchase) as purchase
                            FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_product on m_product.mp_code = o_transaction.ot_product
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member
                            group by om_code,om_name");
        // return  $data;
        // $data = array_merge($data1,$seq);
        $seq = DB::select("SELECT ot_member,sum(ot_sales) sales,sum(ot_purchase) purchase FROM o_transaction where ot_date BETWEEN '$req->date_first' AND '$req->date_end' group by ot_member");
        $data = collect($data);
        // return $data;

        return Datatables::of($data)
            ->addColumn('aksi', function ($data) {
                return'<div class="btn-group">
                            <a href="'.$data->om_code .'/edit_member" class="btn btn-sm txt-color-white bg-color-orange"><i class="fa fa-pencil-square-o"></i></a>
                       </div>';
            })
            ->addColumn('sales', function($data) use($seq){
                    for ($i=0; $i <count($seq) ; $i++) { 
                        if ($data->om_code == $seq[$i]->ot_member) {
                            return 'Rp. '.number_format($seq[$i]->sales,0,'','.');
                        }
                    }
                    
            })
            ->addColumn('purchase', function($data) use($seq){
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
    public function pdf_member(Request $req)
    {
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

        $data = DB::select("SELECT 
                            om_code,om_name,mp_name,SUM(ot_sales) as sales,SUM(ot_purchase) as purchase,ot_operator,om_created_at
                            FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_product on m_product.mp_code = o_transaction.ot_product
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member
                            group by om_code,om_name,mp_name,ot_operator,om_created_at");


        $seq = DB::select("SELECT ot_member,sum(ot_sales) sales,sum(ot_purchase) purchase FROM o_transaction where ot_date BETWEEN '$req->date_first' AND '$req->date_end' group by ot_member");
        
        $sales_awal = 0; 
        $purchase_awal = 0; 
        for ($i=0; $i <count($data) ; $i++) { 
            $sales_awal += $data[$i]->sales;
            $purchase_awal += $data[$i]->purchase;
        }

        if ($data == null) {
            return response()->json(['status'=>'kosong']);
        }else{
            return view('report.rep_member.rep_member_pdf',compact('data','sales_awal','purchase_awal'));
        }
    }


    public function excel_member (Request $req)
    {
        
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

        $data = DB::select("SELECT 
                            om_code,om_name,mp_name,SUM(ot_sales) as sales,SUM(ot_purchase) as purchase,ot_operator,om_created_at
                            FROM o_transaction 
                            LEFT JOIN o_member on o_member.om_code = o_transaction.ot_member
                            LEFT JOIN users on users.id = o_transaction.ot_operator
                            LEFT JOIN m_product on m_product.mp_code = o_transaction.ot_product
                            LEFT JOIN m_keterangan_txn on m_keterangan_txn.mt_code = o_transaction.ot_keterangan_txn
                            WHERE ot_date BETWEEN '$req->date_first' AND '$req->date_end' $admin $product $member
                            group by om_code,om_name,mp_name,ot_operator,om_created_at");
        
        $seq = DB::select("SELECT ot_member,sum(ot_sales) sales,sum(ot_purchase) purchase FROM o_transaction where ot_date BETWEEN '$req->date_first' AND '$req->date_end' group by ot_member");

        // return $data;

        $sales_awal = 0; 
        $purchase_awal = 0; 
        for ($i=0; $i <count($data) ; $i++) { 
            $sales_awal += $data[$i]->sales;
            $purchase_awal += $data[$i]->purchase;
        }

        if ($data == null) {
            return response()->json(['status'=>'kosong']);
        }else{
            Excel::create('Member '.date('d-m-y'), function($excel) use ($data,$sales_awal,$purchase_awal){
            $excel->sheet('New sheet', function($sheet) use ($data,$sales_awal,$purchase_awal) {
                $sheet->loadView('report.rep_member.rep_member_excel')
                ->with('data',$data)
                ->with('sales_awal',$sales_awal)
                ->with('purchase_awal',$purchase_awal);
            });

            })->download('csv');
        }
        
        
    }
}
