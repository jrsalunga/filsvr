<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = array("firstname","middlename", "lastname", "birthday", "contact_no","address", "email", "nationality");
    protected $appends = array("full_name");

    public function getFullNameAttribute()
    {
    	return ucfirst($this->firstname)." ".ucfirst($this->lastname);
    }
}
