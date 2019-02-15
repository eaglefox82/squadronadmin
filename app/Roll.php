<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    //
    protected $fillable = [
        'id', 'roll_id', 'member_id', 'status'
    ];

   public function Status()
   {
       return $this->hasOne('App\RollStatus','status_id', 'Status');
   }
}