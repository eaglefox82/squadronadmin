<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events;
use App\Member;

class Other_attendance extends Model
{
    protected $fillable = [
        'id', 'member_id', 'event_id', 'first_name', 'last_name', 'relationship', 'status', 'form17', 'paid'
    ];

    protected $table = 'other_attendance';


    public function Event()
    {
        return $this->hasOne('App\Events', 'id', 'event_id');
    }

    public function member()
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }

}
