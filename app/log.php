<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
   protected $table = 'm_log';
   protected $primaryKey = 'ml_id';
   const CREATED_AT = 'ml_created_at';
   const UPDATED_AT = 'ml_updated_at';

   protected $fillable = ['ml_id','ml_operator','ml_member','ml_transaction','ml_notes','ml_ref','ml_created_at','ml_updated_at'];

}
