<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	
	protected $fillable = [
	'no',
	'name',
	'expiration',
	'cvc',
	'type',
	'is_bdo',
	'booking_id'];




	public function card()
	{
		return $this->belongsTo("App\Booking");
	}
	
}
