<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    //

    protected $fillable = [
        'id', 'member_id', 'amount'
    ];



    public function member()
    {
        return $this->belongsTo('App\Member', 'id', 'member_id');
    }

    public function getBalanceAttribute()
    {
        return $this->sum('amount');
    }

}
