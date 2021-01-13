<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OtherItem;

class Otheritemmapping extends Model
{
    //
    protected $fillable = [
        'id','item', 'active'
    ];

    protected $table = 'otheritemsmapping';

    public function itemmapping()
    {
        return $this->hasMany('App\OtherItem');
    }

}
