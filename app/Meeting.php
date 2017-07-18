<?php

namespace App;

use Carbon\Carbon;
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

    public function registrations(){
        return $this->hasMany('App\Registration');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function times(){
    	return $this->hasMany('App\Time');
    }

    public function formatMonth($month){
	    $months[1] = "Tammikuu";
	    $months[2] = "Helmikuu";
	    $months[3] = "Maaliskuu";
	    $months[4] = "Huhtikuu";
	    $months[5] = "Toukokuu";
	    $months[6] = "Kesäkuu";
	    $months[7] = "Heinäkuu";
	    $months[8] = "Elokuu";
	    $months[9] = "Syyskuu";
	    $months[10] = "Lokakuu";
	    $months[11] = "Marraskuu";
	    $months[12] = "Joulukuu";
	    return $months[Carbon::createFromTimestamp(strtotime("1.".$month))->format('n')]." ".Carbon::createFromTimestamp(strtotime("1.".$month))->format('Y');
    }

    public function formatDay($day, $month){
	    $days[0] = "su";
	    $days[1] = "ma";
	    $days[2] = "ti";
	    $days[3] = "ke";
	    $days[4] = "to";
	    $days[5] = "pe";
	    $days[6] = "la";
		return $days[Carbon::createFromTimestamp(strtotime($day.".".$month))->format('w')]." ".Carbon::createFromTimestamp(strtotime($day.".".$month))->format('j');
    }
}
