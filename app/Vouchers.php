<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    //
    protected $fillable = [
        'id', 'member_id','voucher_type', 'voucher_number', 'status'
    ];


    Public function member()
    {
        return $this->hasOne('App\Member', 'id', 'member_id');
    }

    Public function vstatus()
    {
        return $this->hasOne('App\VoucherStatus', 'status_code', 'status');
    }

    Public function type()
    {
        return $this->hasOne('App\VoucherType', 'voucher_code', 'voucher_type');
    }
}
