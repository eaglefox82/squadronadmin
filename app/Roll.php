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


   public function rollstatus()
   {
       return $this->hasOne('App\RollStatus','status_id', 'status');
   }

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function rollmapping()
    {
        return $this->hasOne('App\Rollmapping', 'id','roll_id');
    }

    public function Activekids()
    {
        return $this->hasMany('App\ActiveKids', 'member_id', 'member_id');
    }

    public function updateData($id, $data)
    {
        DB::table('roll')->where('id', $id)->update($data);
    }

}



