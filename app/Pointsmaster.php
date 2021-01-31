<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pointsmaster extends Model
{
    //

    protected $table = 'Pointsmaster';

    protected $fillable = [
        'id', 'Reason', 'Value'
    ];


}
