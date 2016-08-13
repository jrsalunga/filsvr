<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Http\Requests;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
	public function __construct()
	{
		
	}

	public function index(Request $request)
	{

		if($request->ajax())
		{

			$date = date("Y-m-d");
			if($request->has("previous"))
			{
				$date=date("Y-m-d", strtotime('-1 day '.$request->get("previous")));
			}else if($request->has("next"))
			{
				$date=date("Y-m-d", strtotime('+1 day '.$request->get("next")));
			}
			$availablerooms = 0;
			$checking_out = 0;
			$checking_in = 0;
			$for_checking_out = 0;
			$cancelled_booking = 0;
			$pending_booking = 0;
			$total_revenue = 0;
			$rooms = \App\Room::all();
			foreach($rooms as $room)
			{
				if($room->status=="available")
					$availablerooms++;
			}
			$bookings = \App\Booking::where("updated_at", "like", "%$date%")->get();
			if(count($bookings) < 1)
			{
				$output = array();
				$output['date'] = $date;
				$output['available_rooms'] = $availablerooms;
				$output['checking_out'] = 0;
				$output['checking_in'] = 0;
				$output['for_checking_out'] = 0;
				$output['cancelled_booking'] = 0;
				$output['pending_booking'] = 0;
				$output['total_revenue'] = 0;
				return $output;
			}
			$check_in = \Carbon::parse($bookings->check_in);
			$check_out = \Carbon::parse($bookings->check_out);
			$today = \Carbon::now();
			foreach($bookings as $booking)
			{
				if($booking->booking_status == "completed")
					$checking_out++;
				else if($booking->booking_status=="cancelled")
					$cancelled_booking++;
				else if($booking->booking_status=="pending")
					$pending_booking++;
				
				if($today->gt($check_out))
					$for_checking_out++;

				$total_revenue += $booking->total_price;
			}

				$output = array();
				$output['date'] = $date;
				$output['available_rooms'] = $availablerooms;
				$output['checking_out'] = $checking_out;
				$output['checking_in'] = $checking_in;
				$output['for_checking_out'] = $for_checking_out;
				$output['cancelled_booking'] = $cancelled_booking;
				$output['pending_booking'] = $pending_booking;
				$output['total_revenue'] = number_format($total_revenue,2);
				return $output;
	}

	return view("admin.dashboard.index");
}

public function store()
{

}

public function patch()
{

}

public function put()
{

}

public function destroy()
{

}






/*login view*/
public function viewLogin()
{
	return view("admin/login");
}

  //execute login
public function checkLogin(Request $request, loginRequest $loginRequest)
{
	$credentials = $loginRequest->only('username', 'password');
	if(\Auth::attempt($credentials))
	{
		return redirect()->intended('admin');
	}
	return back()->withErrors(['Your username and password is incorrect']);
}


  //logout user
public function logout()
{

}





}
