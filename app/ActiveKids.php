<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveKids extends Model
{
    //
    protected $fillable = [
        'id', 'member_id', 'voucher_number', 'date_received', 'balance', 'active'
    ];

    public function member()
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }
}


