<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    //

    protected $fillable = [
        'id', 'member_id', 'value','year', 'reason'
    ];



    public function member()
    {
        return $this->belongsTo('App\Member', 'id', 'member_id');
    }


}
