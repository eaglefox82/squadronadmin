<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use App\Rollmapping;
use App\Member;

class Roll extends Model
{
    //

    protected $table = 'rolls';
    protected $fillable = [
        'id', 'roll_id', 'member_id', 'status'


    ];


   public function rollstatus()
   {
       return $this->hasOne('App\RollStatus','status_id', 'status');
   }

    public function member()
    {
        return $this->hasOne('App\Member', 'id', 'member_id')->orderBy('rank');
    }

    public function rollmapping()
    {
        return $this->hasOne('App\RollMapping', 'id','roll_id');
    }

    public function accounts()
    {
        return $this->hasMany('App\Account', 'member_id', 'member_id');
    }

    public function updateData($id, $data)
    {
        DB::table('roll')->where('id', $id)->update($data);
    }

}



