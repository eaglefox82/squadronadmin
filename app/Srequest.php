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
        return $this->hasMany('App\Requestitems');
    }

    public function requestpayment()
    {
        return $this->hasMany('App\Requestpayment', 'request_id', 'id');
    }

    public function memberrequest()
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }

}
