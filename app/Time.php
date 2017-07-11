<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
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
}
