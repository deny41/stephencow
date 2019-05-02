<?php

namespace App\Http\Controllers\additional;
use App\Http\Controllers\Controller;
use DB;
use auth;
use App\log;
use Carbon\carbon;
use Illuminate\Http\Request;

class logController extends Controller
{
 
    public function index()
    {
        $data = log::all()->take(10);
        
        return view('additional.log.index_log',compact('data'));
    }
    public function log_detail()
    {
        $data = log::all();
        
        return view('additional.log.detail_log',compact('data'));
    }
  
}
