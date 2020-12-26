<?php

namespace App;
use App\Eventroll;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    //
    protected $table = 'events';

    protected $fillable = [
        'id','event', 'event_level', 'year'
    ];

    public function events()
    {
        return $this->hasmany('App\Eventroll', 'event_id', 'id');
    }

    public function member()
    {
        return $this->hasone('App\Member', 'id', 'member_id');
    }
}
