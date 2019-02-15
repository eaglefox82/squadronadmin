<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activekids extends Model
{
    //
    protected $fillable = [
        'id', 'member_id', 'voucher_number', 'date_received', 'balance', 'active'
    ];

}