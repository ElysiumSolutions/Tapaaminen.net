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

    /**
     * Get the meeting times
     */
    public function times(){
    	return $this->hasMany('App\MeetingTime');
    }

    /** 
     * Get the meeting settings
    */
    public function settings(){
    	return $this->hasOne('App\MeetingSetting');
    }

    /**
     * Get the user
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
