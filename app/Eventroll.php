<?php

namespace App;

use App\Member;
use App\Events;

use Illuminate\Database\Eloquent\Model;

class Eventroll extends Model
{
    //
    protected $table = 'eventrolls';

    protected $fillable = [
        'id','event_id', 'member_id', 'status', 'form17', 'paid'
    ];

    public function members()
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }

    public function event()
    {
        return $this->hasOne('App\Events', 'id', 'event_id');
    }
}
