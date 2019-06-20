<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Srequest extends Model
{
    //
    protected $fillable = [
        'id','overview', 'invoice_number', 'invoice_total', 'payment', 'complete', 'requested_date'
    ];

    protected $table = 'requests';

    public function requesitem()
    {
        return $this->hasMany('App\requestitems');
    }

    public function requestpayment()
    {
        return $this->hasMany('App\requestpayment', 'request_id', 'id');
    }

    public function memberrequest()
    {
        return $this->hasOne('App\member', 'id', 'member_id');
    }

}