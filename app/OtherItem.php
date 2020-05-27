<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Otheritemmapping;

class OtherItem extends Model
{
    protected $table = "otheritems";

    //
    protected $fillable = [
        'id','member_id', 'item_id', 'string', 'amount', 'paid', 'date', 'roll_id'
    ];

    public function itemmapping()
    {
        return $this->hasOne('App\OtherItemsMapping', 'item_id', 'id');
    }

}
