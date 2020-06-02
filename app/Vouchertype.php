<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    //
    protected $table = 'vouchertype';

    protected $fillable = [
        'id', 'voucher_code','voucher_type'
    ];

    public function type()
    {
        return $this->hasMany('App\Vouchers', 'voucher_type', 'voucher_code');
    }
}
