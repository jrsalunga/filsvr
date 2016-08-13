<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\BookingIdGenerator;

class Booking extends Model
{

	protected $fillable = [
	'booking_no',
	'customer_id',
	'status',
	'additional_remarks',
	'booking_status',
	'total_price',
	'amount_paid',
	'credits',	
	'max_online_booking',
	'payment_status'];

	protected $appends = [
	'check_in',
	'check_out'];

	public function rooms()
	{
		return $this->hasMany("App\BookedRoom", "booking_id", "id");
	}

	public function additionalTransaction()
	{
		return $this->hasMany("App\AdditionalTransaction","booking_id", "id");
	}

	/*mutators==========*/

	public function getCheckInAttribute()
	{
		$booked_room = \App\BookedRoom::where("booking_id", $this->id)->first();
		if($booked_room)
		{
			return $booked_room->check_in;
		}
		return "n/a";
	}

	public function customer()
	{
		return $this->belongsTo("\App\Customer", "customer_id", "id");
	}
	public function getCheckOutAttribute()
	{
		$booked_room = \App\BookedRoom::where("booking_id", $this->id)->orderBy("created_at","DESC")->first();
		if($booked_room)
		{
			return $booked_room->check_out;
		}
		return "n/a";

	}

}
