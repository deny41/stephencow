<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keterangan_txn extends Model
{
   protected $table = 'm_keterangan_txn';
   protected $primaryKey = 'mt_id';
   const CREATED_AT = 'mt_created_at';
   const UPDATED_AT = 'mt_updated_at';

   protected $fillable = ['mt_id','mt_code','mt_desc','mt_notes','mt_created_at','mt_updated_at'];

}
