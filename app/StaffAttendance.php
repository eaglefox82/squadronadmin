<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member;

class StaffAttendance extends Model
{
    //
      protected $table = 'staff_attendance';

    protected $fillable = [
        'id','date'
    ];

    public function member()
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }
}
