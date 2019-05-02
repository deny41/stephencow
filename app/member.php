<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
   protected $table = 'o_member';
   protected $primaryKey = 'om_id';
   const CREATED_AT = 'om_created_at';
   const UPDATED_AT = 'om_updated_at';

   protected $fillable = ['om_id',
   						  'om_code',
                       'om_web_regist',
   						  'om_name',
   						  'om_email',
   						  'om_operator',
   						  'om_product',
   						  'om_phone1',
   						  'om_phone2',
   						  'om_line',
   						  'om_bbm',
   						  'om_bank',
   						  'om_name_rek',
   						  'om_no_rek',
   						  'om_web_regist',
   						  'om_keterangan_mem',
   						  'om_notes',
   						  'om_created_at',
   						  'om_updated_at'];

}
