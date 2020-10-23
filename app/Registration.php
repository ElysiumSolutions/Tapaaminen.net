<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
	use Uuids;

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
