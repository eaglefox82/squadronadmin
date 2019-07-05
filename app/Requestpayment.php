<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestpayment extends Model
{
    //
    protected $fillable = [
        'id', 'request_id', 'roll_id', 'amount'
    ];

    Public function request()
    {
    return $this->belongsTo('App\Srequest');
    }

    Public function date()
    {
        return $this->hasOne('App\Rollmapping', 'id', 'roll_id');
    }
}
