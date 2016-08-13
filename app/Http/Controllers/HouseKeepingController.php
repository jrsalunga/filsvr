<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\RoomType;
class HouseKeepingController extends Controller
{
   
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

		return view("housekeeping.index", compact("roomtype"));
	}

  
}
