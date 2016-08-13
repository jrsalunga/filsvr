<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalTransaction extends Model
{
    protected $fillable = array(
    	"amount",
    	"booking_id",
    	"description",
    	"reference_no");
}
