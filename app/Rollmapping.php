<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rollmapping extends Model
{
    //
    protected $fillable = [
        'id', 'roll_date', 'roll_year', 'roll_month', 'roll_week'
    ];
    
    protected $table = 'Rollmapping';
}