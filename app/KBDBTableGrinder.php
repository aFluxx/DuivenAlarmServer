<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KBDBTableGrinder extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kbdb_table_history';
}
