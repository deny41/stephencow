<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keterangan_mem extends Model
{
   protected $table = 'm_keterangan_member';
   protected $primaryKey = 'mk_id';
   const CREATED_AT = 'mk_created_at';
   const UPDATED_AT = 'mk_updated_at';

   protected $fillable = ['mk_id','mk_code','mk_desc','mk_notes','mk_created_at','mk_updated_at'];

}
