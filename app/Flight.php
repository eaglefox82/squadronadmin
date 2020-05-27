<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    //

    protected $fillable = [
        'id', 'flight_name'
    ];

    protected $table = 'flight';

    public function member()
    {
        return $this->belongsTo('App\Member', 'flight', 'id');
    }
}
