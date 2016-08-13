<?php

namespace App;
use Carbon\Carbon;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
    'firstname','lastname','middlename', 'email', 'password','username','user_type'
    ];

    protected $appends = ['created_at_str'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */

    protected $hidden = [
    'password', 'remember_token',
    ];

    /*mutators*/
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /*accessors*/
    public function getFirstnameAttribute($value)
    {
        return ucwords($value);
    }

    public function getLastnameAttribute($value)
    {
        return ucwords($value);
    }

    public function getPasswordAttribute($value)
    {
        if(empty($value) || $value==="")
        {
            return Hash::make(strtolower($this->lastname));
        }
        return $value;
    }

    public function getCreatedAtStrAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }


}
