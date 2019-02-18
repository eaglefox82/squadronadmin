<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activekids extends Model
{
    //
    protected $fillable = [
        'id', 'member_id', 'voucher_number', 'date_received', 'balance', 'active'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function setting()
    {
        return $this->belongsTo('App\Settings');
    }
}