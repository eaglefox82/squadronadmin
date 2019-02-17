<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    //
    protected $fillable = [
        'id', 'roll_id', 'member_id', 'status'
    ];

    protected $table = 'Roll';

   public function Status()
   {
       return $this->hasOne('App\RollStatus','status_id', 'Status');
   }

   public function Rollid()
    {
        return $this->hasMany('App\Rollmapping','roll_id', 'id');
    }
}



