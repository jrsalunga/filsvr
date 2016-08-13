<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookedRoom extends Model
{
	protected $table = "booked_rooms";
	protected $fillable = [
	'check_in',
	'check_out',
	'total_price',
	'room_id',
	'booking_id',
	'room_type_id',
	'num_adults',
	'num_children',
	'room_price',
	'food_price',

	];
	
	public function roomTypeDetails()
	{
		return $this->belongsTo("App\RoomType", "room_type_id", "id");
	}

	public function bookingDetails()
	{
		return $this->belongsTo("App\Booking", "booking_id", "id");
	}

	public function roomDetails()
	{
		return $this->belongsTo("App\Room", "room_id", "id");
	}
	/*scopes */
	public function scopeAvailability($query, $check_in, $check_out)
	{
		return $query->whereBetween('check_in', array($check_in, $check_out))
		->orWhereBetween('check_out', array($check_in, $check_out))
		->orWhereRaw('"'.$check_in.'" between check_in and check_out')
		->orWhereRaw('"'.$check_out.'" between check_in and check_out');
	}
}
