<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class web_regist extends Model
{
   protected $table = 'm_web_registration';
   protected $primaryKey = 'mw_id';
   const CREATED_AT = 'mw_created_at';
   const UPDATED_AT = 'mw_updated_at';

   protected $fillable = ['mw_id','mw_name','mw_notes','mw_created_at','mw_updated_at'];

}
