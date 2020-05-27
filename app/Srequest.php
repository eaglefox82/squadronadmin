<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Srequest extends Model
{
    //
    protected $fillable = [
        'id','member_id','overview', 'invoice_number', 'invoice_total', 'payment', 'complete', 'requested_date'
    ];

    protected $table = 'requests';

    public function requesitem()
    {
        return $this->hasMany('App\RequestItem');
    }

    public function requestpayment()
    {
        return $this->hasMany('App\RequestPayment', 'request_id', 'id');
    }

    public function memberrequest()
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }

}
