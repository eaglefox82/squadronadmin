<?php

namespace App;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class RollMapping extends Model
{
    //
    protected $table = 'rollmappings';

    protected $fillable = [
        'id', 'roll_date', 'roll_year', 'roll_month', 'roll_week'
    ];

    public function roll()
    {
        return $this->hasMany('App\Roll', 'roll_id', 'id');
    }

    public function totalweeks()
    {
        return $this->rollmapping();
    }

    public function officercount()
    {
        return $this->roll()->where('status', '!=', 'A')
            ->whereHas('member', function($q){
                $q->where('rank', '<=', 11);
            })
            ->count();
    }

    public function tocount()
    {
        return $this->roll()->where('status', '!=', 'A')
            ->whereHas('member', function($q){
                $q->whereBetween('rank', [12,13]);
            })
            ->count();
    }

    public function ncocount()
    {
        return $this->roll()->where('status', '!=', 'A')
            ->whereHas('member', function($q){
                $q->where('rank', '>=', 14)->where('rank', '<=', 18);
            })
            ->count();
    }

    public function cadetcount()
    {
        return $this->roll()->where('status', '!=', 'A')
            ->whereHas('member', function($q){
                $q->where('rank', '>', 18);
            })
            ->count();
    }

    public function total()
    {
        return $this->roll()->where('status', '!=', 'A')
            ->count();
    }
}
