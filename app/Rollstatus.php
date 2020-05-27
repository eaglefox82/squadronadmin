<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RollStatus extends Model
{
    //
    protected $fillable = [
        'id', 'status_id', 'status'
    ];

    protected $table = 'rollstatus';
}
