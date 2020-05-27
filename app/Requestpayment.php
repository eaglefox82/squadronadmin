<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestPayment extends Model
{
    protected $table = "requestpayments";
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
        return $this->hasOne('App\RollMapping', 'id', 'roll_id');
    }
}
