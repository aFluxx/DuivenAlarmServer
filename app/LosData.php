<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LosData extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function setLosplaatsAttribute($value)
    {
        $this->attributes['losplaats'] = ucfirst(strtolower($value));
    }

    public function setOpmerkingAttribute($value)
    {
        $this->attributes['opmerking'] = ucfirst(strtolower($value));
    }
}
