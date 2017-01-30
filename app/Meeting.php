<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use Uuids;
    use SoftDeletes;
    // We use uuids instead
    public $incrementing = false;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function settings(){
        return $this->hasOne('App\Setting');
    }

    public function times(){
        return $this->hasOne('App\Time');
    }

    public function registrations(){
        return $this->hasMany('App\Registration');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
