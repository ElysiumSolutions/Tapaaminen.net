<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\ResetPassword as ResetPasswordNotification;


class User extends Authenticatable
{
    use Notifiable;
    use Uuids;
    use SoftDeletes;

    // We use uuids instead
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'subscribed'
    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'last_login',
        'emailVerificationDate',
        'emailVerificationSendDate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function threads(){
        return $this->hasMany('App\Thread');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function meetings(){
        return $this->hasMany('App\Meeting');
    }

    public function registrations(){
        return $this->hasMany('App\Registration');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
