<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use Uuids;
    use SoftDeletes;
    // We use uuids instead
    public $incrementing = false;
    protected $keyType = 'string';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function meeting(){
        return $this->belongsTo('App\Meeting');
    }
}
