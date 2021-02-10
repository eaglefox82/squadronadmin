<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events;

class Eventlevels extends Model
{
    //
    protected $table = 'eventlevels';

    protected $fillable = [
        'id','level', 'points_rank'
    ];

    public function event()
    {
        return $this->hasone('App\Event', 'event_level', 'id');
    }

}
