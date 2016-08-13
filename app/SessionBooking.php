<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionBooking extends Model
{
    protected $table="session_booking";
    protected $fillable = ['ip_address'];
}
