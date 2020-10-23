<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Uuids;
    use SoftDeletes;

    // We use uuids instead
    public $incrementing = false;
    protected $keyType = 'string';

    protected $touches = ['thread'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function thread(){
        return $this->belongsTo('App\Thread');
    }

}
