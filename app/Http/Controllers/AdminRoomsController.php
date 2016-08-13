<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomType;
use App\Room;
use App\Http\Requests;
use App\Http\Requests\AddRoom;
use App\Http\Requests\UpdateRoom;

class AdminRoomsController extends Controller
{
	public function __construct()
	{

	}

	public function index(Request $request)
	{
		$roomtype = null;
		if($request->has("room_id"))
		{
			try
			{
				$roomtype = RoomType::where('id',$request->get("room_id"))->with("rooms.details")->first();
			}catch(Exception $e)
			{
				return "Something went wrong. Please try again later.";
			}
		}else
		{
			$roomtype = RoomType::with("rooms.details")->get();
		}
		

		if($request->ajax())
		{

			return $roomtype;
		}

		return view("admin.rooms.index", compact("roomtype"));
	}

	public function store(AddRoom $request)
	{
		try
		{
			$roomtype = RoomType::all();
			$input = $request->all();
			$room = new Room;
			$room->room_type_id = $input['room_type'];
			$room->view = $request->get("view", "n/a");
			$room->room_no = $request->get("room_no","n/a");
				//return $request->all();
			$room->save();

			$room_type_name = array_where($roomtype, function ($key, $value) use ($room) 
			{
				return ($value->id == $room->room_type_id) ? $value->name : "";
			});
			$room_type_name = array_flatten($room_type_name);
			return back()->withSuccess("You have successfull added a room to room type <strong>".$room_type_name[0]->name."</strong>");
		}catch(Exception $e)
		{
			return back()->withErrors(['Error saving to database, please try again later.']);
		}
	}

	public function create(Request $request)
	{
		$roomtype = RoomType::all();
		$selectedroomtype = $request->get("room-type","");
		return view("admin.rooms.add_room", compact("roomtype", "selectedroomtype"));
	}

	public function edit($id)
	{

	}

	public function update($id, UpdateRoom $request)
	{
		$input = $request->all();
		try
		{
			$room = Room::find($id);
			$room->view = $input['view'];
			$room->status = $input['status'];
			$room->room_no = $request->get("room_no","n/a");
			$room->target_booking = $request->get("target_booking", "walk-in");
			$room->room_type_id = $input['room_type'];
			$room->save();

			$output = array();
			$room_all = array();
			if($request->has("selectedRoomType"))
			{
				$room_all = RoomType::where("id", $request->get("selectedRoomType"))->with("rooms")->first();
			}else
			{
				$room_all = RoomType::with("rooms")->get();
			}
			
			$output['selected'] = $room;
			$output['allroom'] = $room_all;
			return json_encode($output);
		}catch(Exception $e)
		{

		}
	}

	public function delete($id)
	{	

		try {
			$room = Room::with('details')->findOrFail($id);
			
			return view("admin.rooms.delete.room", compact("room"));
		} catch (Exception $e) {
			App::abort(404);	
		}
	}

	public function destroy($id)
	{
		try
		{
			$room = Room::findOrFail($id);

			$room->destroy($id);
			return redirect("admin/rooms/")->withSuccess("You have successfully deleted a room");  
		}catch(Exception $e)
		{
			;
			App::abort(404);
		}

	}
}
