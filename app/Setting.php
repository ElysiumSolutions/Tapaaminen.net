<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use Uuids;
    use SoftDeletes;
    // We use uuids instead
    public $incrementing = false;
    protected $keyType = 'string';

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'endtime'
	];

    public function meeting(){
        return $this->belongsTo('App\Meeting');
    }
}
