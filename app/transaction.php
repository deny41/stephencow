<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
   protected $table = 'o_transaction';
   protected $primaryKey = 'ot_id';
   const CREATED_AT = 'ot_created_at';
   const UPDATED_AT = 'ot_updated_at';

   protected $fillable = ['ot_id',
   						  'ot_code',
   						  'ot_operator',
                       'ot_sales',
   						  'ot_product',
   						  'ot_purchase',
   						  'ot_first_credit',
   						  'ot_last_credit',
   						  'ot_keterangan_txn',
                       'ot_notes',
   						  'ot_date',
   						  'ot_created_at',
   						  'ot_updated_at'];

}
