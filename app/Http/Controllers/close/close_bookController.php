<?php

namespace App\Http\Controllers\close;
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

class close_bookController extends Controller
{
 
    public function close_book()
    {

        return view('close.close_book',compact('data'));
    }
    public function update_book(Request $req)
    {
        // dd($req->all());
        $date = date('Y-m-d H:i:s');

        $data = DB::table('o_transaction')
                    ->where('ot_date',$req->date_first)
                    ->update([
                        'ot_status'=>'CLOSE',
                        'ot_updated_at'=>$date,
                    ]);

        if ($data == true) {
            return response()->json(['status'=>'sukses']);
        }

    }

}
