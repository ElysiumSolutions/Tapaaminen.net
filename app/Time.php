<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Time extends Model
{
    use Uuids;
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'day'
    ];

    // We use uuids instead
    public $incrementing = false;

    public function meeting(){
        return $this->belongsTo('App\Meeting');
    }

    public function registrations(){
        return $this->hasMany('App\Registration');
    }
}
