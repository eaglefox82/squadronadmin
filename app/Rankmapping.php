<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RankMapping extends Model
{
    protected $table = "rankmappings";
    //
    protected $fillable = [
        'id', 'rank'
    ];

}
