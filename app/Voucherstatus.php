<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherStatus extends Model
{
    //

    protected $fillable = [
        'id', 'status_code','desc'
    ];

    public function status()
    {
        return $this->hasMany('App\Vouchers', 'status', 'status_code');
    }

    Protected $table = 'voucherstatus';
}

