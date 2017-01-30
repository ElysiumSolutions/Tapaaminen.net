<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Time extends Model
{
    use Uuids;
    use SoftDeletes;
    // We use uuids instead
    public $incrementing = false;

    public function meeting(){
        return $this->belongsTo('App\Meeting');
    }

    public function registrations(){
        return $this->hasMany('App\Registration');
    }
}
