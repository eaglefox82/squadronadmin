<?php

namespace App;
use App\Eventroll;
use App\Eventlevels;
use App\Carbon;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    //
    protected $table = 'events';

    protected $fillable = [
        'id','event', 'event_level', 'year', 'amount', 'finished'
    ];

    public function events()
    {
        return $this->hasmany('App\Eventroll', 'event_id', 'id');
    }

    public function level()
    {
        return $this->hasone('App\Eventlevels', 'id', 'event_level');
    }
}
