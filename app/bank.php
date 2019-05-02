<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
   protected $table = 'm_bank';
   protected $primaryKey = 'mb_id';
   const CREATED_AT = 'mb_created_at';
   const UPDATED_AT = 'mb_updated_at';

   protected $fillable = ['mb_id','mb_code','mb_name','mb_notes','mb_created_at','mb_updated_at'];

}
