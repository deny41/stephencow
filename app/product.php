<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
   protected $table = 'm_product';
   protected $primaryKey = 'mp_id';
   const CREATED_AT = 'mp_created_at';
   const UPDATED_AT = 'mp_updated_at';

   protected $fillable = ['mp_id','mp_code','mp_name','mp_notes','mp_created_at','mp_updated_at'];

}
