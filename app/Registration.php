<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use Uuids;
    use SoftDeletes;
    // We use uuids instead
    public $incrementing = false;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function meeting(){
        return $this->belongsTo('App\Meeting');
    }

    public function time(){
        return $this->belongsTo('App\Time');
    }
}
