<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ActiveKids;
use App\Rollmapping;
use App\Member;

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

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function rollmapping()
    {
        return $this->hasOne('App\Rollmapping');
    }

    public function Activekids()
    {
        return $this->hasMany('App\ActiveKids', 'member_id', 'member_id');
    }



}



