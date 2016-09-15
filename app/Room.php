<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Room;


class Room extends Model
{
	protected $fillable = ["view","room_no", "status", "room_type_id"];
	protected $appends = ['room_no_str', 'quantity','disable_booking','input_food', 'input_children', 'input_adult'];

	public function details()
	{
		return $this->belongsTo("App\RoomType", "room_type_id", 'id');
	}

	public function getStatusAttribute($value)
	{
		$booked_room = \App\BookedRoom::where(function($query1)
		{
			$query1->where("room_id", $this->id);
		})->availability(date("Y-m-d"), date("Y-m-d"))->first();
		
		$booked_rooms = BookedRoom::where("room_type_id", $this->room_type_id)->with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out']);
		$booked_rooms_arr = array();
		if($booked_rooms->count() >0)
		{
			foreach($booked_rooms->get() as $br)
			{
				if($br->room_id == $input['room_id'] && $br->bookingDetails->booking_status != "cancelled")
				{
					return "booked";
				}
				if($booked_rooms->count() > $br->roomTypeDetails->quantity)
				{
					return "booked";
				}
			}
		}
		
		return ($booked_room) ? "booked": $value;
	}

	/*accessors*/
	public function getRoomNoStrAttribute()
	{
		return ($this->room_no=="") ? "n/a":$this->room_no;
	}

	public function getDisableBookingAttribute()
	{
		return "true";
	}

	public function getInputChildrenAttribute()
	{
		return "0";
	}

	public function getInputAdultAttribute()
	{
		return "0";
	}

	public function getInputFoodAttribute()
	{
		return "0";
	}

	public function getQuantityAttribute()
	{
		$room = Room::where("room_type_id", $this->id)->count();
		return $room;
	}

	/*mutators*/
}
