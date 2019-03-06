<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Otheritemmapping;

class Otheritem extends Model
{
    //
    protected $fillable = [
        'id','member_id', 'item_id', 'string', 'amount', 'paid', 'date', 'roll_id'
    ];

    public function itemmapping()
    {
        return $this->hasOne('App\Otheritemsmapping', 'item_id', 'id');
    }

}