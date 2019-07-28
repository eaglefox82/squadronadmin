<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $fillable = [
        'id','item','cost','qty','location','current'
    ];

    protected $table = 'stock';
}
