<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Requestitems;

class Srequest extends Model
{
    //
    protected $fillable = [
        'id','overview', 'invoice_number', 'invoice_total', 'payment', 'complete', 'requested_date'
    ];

    protected $table = 'requests';

    public function requesitem()
    {
        return $this->hasMany('App\requestitems');
    }

}