<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');
        $date_7 = strtotime ( '-7 day' , strtotime ( $date ));
        $date_min7 = date('Y-m-d' , $date_7);;

        $data_transaction = DB::select("SELECT ot_date ,
                                        SUM(ot_purchase) as  sales_purchase ,
                                        SUM(ot_sales) as sales_total 
                                        FROM o_transaction 
                                        WHERE ot_date BETWEEN '$date_min7' AND '$date'
                                        group by ot_date");

        $tgl = DB::select("SELECT ot_date FROM o_transaction WHERE ot_date BETWEEN '$date_min7' AND '$date' group by ot_date");
        $product_transaction = DB::select("SELECT ot_date,count(ot_product) as prd,ot_product FROM o_transaction WHERE ot_date BETWEEN '$date' AND '$date' group by ot_product,ot_date");


        $admin = user::all();
        $member = member::all();
        $product = product::all();

        return view('home',compact('data_transaction','admin','member','product','product_transaction','tgl'));
    }
}
