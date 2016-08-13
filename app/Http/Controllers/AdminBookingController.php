<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\DateRequest;
use App\Http\Requests;
use App\Booking;
use App\PricingCalendar;
use App\BookedRoom;
use App\RoomType;
use App\SessionBooking;
use App\Http\Requests\BookingRoomsRequest;
use \Carbon;
use \PDF;
use \Auth;
use App\AdditionalTransaction;
use App\Http\Requests\AdditionalTransactionRequest;
use App\Http\Requests\FilterBookingRequest;
use App\Http\Requests\CreateBookingRequest;
use App\WebsiteSetting;
use App\Customer;

class AdminBookingController extends Controller
{
	public function putDbSession($content_array, $request)
	{
		$session = SessionBooking::firstOrCreate(['ip_address' => $request->ip()]);
		$session->content = json_encode($content_array);
		$session->save();
	}

	public function create()
	{
		return view("admin.booking.create");
	}

	public function getDbSession(Request $request)
	{
		$session = SessionBooking::firstOrCreate(['ip_address' => $request->ip()]);
		return $session->content;
	}

	public function store(CreateBookingRequest $request)
	{
		$input = $request->all();
		
		$payment_option = $request->get("payment_option", "");
		$tmparr = array();
		foreach($input['booked_room_details'] as $brd)
		{
			array_push($tmparr,$brd['room_id']);
		}

		$booked_rooms = BookedRoom::whereIn('room_id',$tmparr)->with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out'])->get();
		//return $tmparr;
		foreach($booked_rooms as $key=>$br)
		{
			if($br->bookingDetails->booking_status=="cancelled")
			{
				unset($booked_rooms[$key]);
			}
		}
		if(count($booked_rooms) < 1)
		{
			try
			{
				switch($payment_option)
				{
					case "partial_payment":
					$payment_option = "Partially Paid";
					break;

					case "full_payment":
					$payment_option =  "Fully Paid";
					break;

					default:
					$payment_option ="N/A";
					break;
				}

				$booking_input = array();
				$booking_input['booking_no'] = uniqid();
				$booking_input['total_price'] =intval(preg_replace('/[^\d.]/', '', $input['total_price']));
				$booking_input['customer_id'] = $input['customer'];
				$booking_input['payment_status'] = $payment_option;
				$booking_input['booking_status'] = "Checked In";
				$booking_input['cashier'] = Auth::user()->firstname." ".Auth::user()->lastname;
				$booking = Booking::create($booking_input);
				if($booking)
				{
					$additional_transaction_input = array();
					$additional_transaction_input['amount'] = (intval(preg_replace('/[^\d.]/', '', $input['amount_paid']))) * -1;
					$additional_transaction_input['description'] = "Partial Payment";
					$additional_transaction_input['reference_no'] = $booking->booking_no;
					$additional_transaction_input['booking_id'] = $booking->id;
					
					$additional_transaction = AdditionalTransaction::create($additional_transaction_input);
					foreach($input['booked_room_details'] as $brd){
						
						$booked_room_input = array();
						$booked_room_input['booking_id'] = $booking->id;
						$booked_room_input['check_in'] = $input['check_in'];
						$booked_room_input['check_out'] = $input['check_out'];
						$booked_room_input['num_adults'] = $brd['adult'];
						$booked_room_input['num_children'] = $brd['children'];
						$booked_room_input['room_type_id'] = $brd['room_type_id'];
						$booked_room_input['room_id'] = $brd['room_id'];
						$booked_room_input['room_price'] = intval(preg_replace('/[^\d.]/', '', $brd['room_price']));
						$booked_room_input['food_price'] = intval(preg_replace('/[^\d.]/', '', $brd['food_price']));

						$booked_room = BookedRoom::create($booked_room_input);
						if($booked_room)
						{
							
						}
					}
					return response("Successfully created", 200);
				}
			}catch(Exception $e)
			{
				return response("Something went wrong. Please try again.", 500);
			}
			
		}
	}
	public function __construct()
	{

	}
	
	public function index(Request $request)
	{
		$filter = $request->input("filter", "");
		$filter_date = $request->input("filter_date", "");
		if($request->ajax())
		{
			$order = $request->input("order","desc");
			$sort = $request->input("sort", "created_at");
			$take = $request->input("limit",10);
			$skip = $request->input("offset", 0);
			$search = $request->input("search", "");
			$customer = $request->input("customer","");
			$roomtype = $request->input("roomtype", "");
			$filter = $request->input("filter", "");
			$filter_date = $request->input("filter_date", "");
			
			switch($filter)
			{
				case 1:
				$filter_date="";
				break;

				case 2:
				$filter_date=date("Y-m-d");
				break;

				case 3:
				$filter_date=date("Y-m-d", strtotime($filter_date));
				break;

				default:
				$filter_date = "";
				break;
			}
			
			$booking = Booking::where(function($query) use ($search)
			{
				$query->where("booking_no", "LIKE", "%$search%")
				
				->where("customer_id", "like", "%$customer%");
			})
			->where("created_at", "LIKE", "%$filter_date%");
			
			$output = array();
			$output['total'] = $booking->count();
			$output['rows'] = $booking->with('customer')->orderBy($sort,$order)->skip($skip)->take($take)->get();
			return $output;
		}
		$customerDetails = false;
		if($request->has("customer"))
		{
			$customerDetails = Customer::whereId($request->get("customer"))->first();
			
		}
		$roomTypeDetails = false;
		if($request->has("roomtype"))
		{
			$roomTypeDetails = RoomType::where("id", $request->get("roomtype"))->first();
		}
		return view("admin.booking.index", compact("filter", "filter_date","customerDetails","roomTypeDetails"));
	}

	public function show($id)
	{

		$booking = Booking::where("booking_no", $id)->with('customer', 'rooms.roomDetails', 'rooms.roomTypeDetails')->first();
		if($booking)
		{
			/* available rooms*/	
			$input['check_in'] = $booking->check_in;
			$input['check_out'] = $booking->check_out;
			$booked_rooms = BookedRoom::with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out'])->get();
			$booked_rooms_arr = array();
			foreach($booked_rooms as $br)
			{
				if(!is_null($br->room_id) && $br->bookingDetails->booking_status!="cancelled") 
					array_push($booked_rooms_arr, $br->room_id);
			}

			$available_rooms = RoomType::with(array("rooms"=>function($query) use ($booked_rooms_arr, $booking)
			{
				$query->whereNotIn("id", $booked_rooms_arr)->where("target_booking", $booking->booking_type);
			},'rooms.details','rooms.details.mealPlans'))->get();

			foreach($available_rooms as $key=>$ar)
			{
				$booked_rooms = BookedRoom::where("room_type_id", $ar->id)->with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out']);
				$booked_rooms_arr = array();
				if($booked_rooms->count() >0)
				{
					foreach($booked_rooms->get() as $br)
					{
						if($br->room_id == $input['room_id'] && $br->bookingDetails->booking_status != "cancelled")
						{
							unset($available_rooms[$key]);
						}
						if($booked_rooms->count() > $br->roomTypeDetails->quantity)
						{
							unset($available_rooms[$key]);
						}
					}
				}
			}

			$available_rooms1 = array();
			foreach($available_rooms as $ar1)
			{
				if(count($ar1) > 0)
				{
					foreach($ar1->rooms as $rooms1)
					{
						array_push($available_rooms1, $rooms1);
					}
				}
			}

			/*end of available rooms*/
			$websitesetting = WebsiteSetting::first();
			$total_additional_transaction = 0;
			foreach($booking->additionalTransaction as $at)
			{
				$total_additional_transaction += $at->amount;
			}
			$total_room_price = 0;
			foreach($booking->rooms as $room)
			{
				$total_room_price+=$room->room_price+$room->food_price;
			}
			$tax_price = 0;
			$tax_price = ((double)$websitesetting->tax / 100) * $total_room_price;
			$booking->total_room_price = $total_room_price;
			$booking->tax_price = $tax_price;
			$booking->additional_transaction_price = $total_additional_transaction;
			//return $booking;
			return view("admin.booking.show", compact('booking','available_rooms1'));
		}
		return abort(404);
		
	}

	public function storeAdditionalTransaction(AdditionalTransactionRequest $request)
	{
		$input = $request->all();
		// renew csrf token to prevent multiple form submission
		\Session::put('_token', sha1(microtime()));
		
		try
		{
			$booking = Booking::with('additionalTransaction')->whereId($input['booking_id'])->first();
			if($booking)
			{
				if($booking->booking_status=="completed")
					return back()->withErrors(array("You can't add more transaction to this booking."));
				$additional_transaction_price = 0;
				foreach($booking->additionalTransaction as $at){
					$additional_transaction_price += $at->amount;	
				}
				$additional_transaction_price += (int) $input['amount'];
				if($additional_transaction_price < 0)
				{
					if($booking->total_price < abs($additional_transaction_price))
					{
						return back()->withErrors(array("Total amount can't become less than zero(0)."));
					}
					else
					{
						$booking->amount_paid += abs($additional_transaction_price);
					}
				}
				$booking->total_price += $additional_transaction_price;		
				$additonaltransaction = AdditionalTransaction::create($input);
				if($additonaltransaction)
				{
					$booking->save();
					return back()->withSuccess("You have successfully added new transaction");
				}

				
			}
			return back()->withErrors(array("Booking Referece No is not valid."));
		}catch(Exception $e)
		{
			return back()->withErrors(array("Something went wrong. Please try again"));
		}
	}

	public function bookingStep2()
	{
		return view("admin.booking.step2");
	}

	public function viewInvoice($id)
	{
		$booking = Booking::where("booking_no", $id)->with('customer','additionalTransaction','rooms.roomDetails.details')->first();
		$booking = $booking->toArray();
		$websitesetting = WebsiteSetting::first();
		$additional_transaction_price = array();// total price of additional transactio
		$total_room_price = 0; // total price of booked rooms;
		$rendered_change = 0;
		$total_price = 0;
		//return $booking['additional_transaction'];
		foreach($booking['additional_transaction'] as $at)
		{
			$additional_transaction_price['credits'] += ($at['amount'] < 0) ? abs($at['amount']) : 0;
			$additional_transaction_price['debits'] += ($at['amount'] > 0) ? $at['amount'] : 0;
		}
		foreach($booking['rooms'] as $rooms)
		{
			$total_room_price += (int)$rooms['room_price'] + (int)$rooms['food_price'];
		}
		$tax_price = $total_room_price * ($websitesetting->tax/100);
		$booking['room_tax_price'] = $tax_price;
		$booking['subtotal_room_price'] = $total_room_price;
		$booking['total_room_price'] = $total_room_price + $tax_price;
		$total_debits =$booking['total_room_price'] + $additional_transaction_price['debits'];
		$rendered_change =($total_credits < $total_debits) ? $total_credits - $total_debits : 0;
		$rendered_change = ($rendered_change > 0) ? $rendered_change : 0;
		$total_credits = $booking['amount_paid'] + $additional_transaction_price['credits'] + $rendered_change;
		$remaining_balance = $total_debits - $total_credits;
		
		$booking['total_debits']  = ($remaining_balance > 0) ? abs($remaining_balance) : 0; 
		$booking['total_credits'] = ($remaining_balance < 0) ? abs($remaining_balance) : 0; 
		$booking['remaining_balance'] = $remaining_balance;
		$booking['additional_transaction_price'] = $additional_transaction_price;
		$booking['rendered_change'] = $rendered_change;
		$booking['tax'] = $websitesetting->tax;
		$booking['sub_total_price'] = $sub_total_price;
		
	//return $booking;

		$pdf = PDF::loadView('admin.booking.invoice', $booking);
		return $pdf->stream('booking'.$booking->id.'.pdf');
		return view("admin.booking.invoice");
	}

	public function update($id, Request $request)
	{
		//\Session::put('_token', sha1(microtime()));
		$input = $request->all();
		$booking = Booking::with('additionalTransaction')->whereId($id)->first();
		if($booking)
		{
			if($request->has("booking_status"))
			{
				if(strtolower($input['booking_status']) == "completed"){
					if($booking->payment_status!="Fully Paid")
					{
						return back()->withErrors(array("Please set the full payment first"));
					}

					$tmp_date = Carbon::parse($booking->check_in);
					$date_now = Carbon::now();
					$tmp_date1 = Carbon::parse($booking->check_out);

					if($tmp_date1->gt($date_now))
					{
						return back()->withErrors(array("Too early to complete this booking."));
					}

					if($tmp_date->gte($date_now) && !$request->has("sure"))
					{
						return back()->withCaution("Are you sure you want to checkout this booking on earlier date?");
					}

					$booking->booking_status = "completed";
					$booking->save();
					return back()->withSuccess("You have successfully changed this booking status.");
				}
			}
			else if($request->has("payment_status"))
			{
				$additional_transaction_price = 0;
				foreach($booking->additionalTransaction as $at)
				{
					if($at->amount < 0)
						$additional_transaction_price += $at->amount;
				}

				$difference = abs($additional_transaction_price) - $booking->total_price;
				$difference *=-1;
				if($difference < 0)
				{
					$input['reference_no'] = $booking->booking_no;
					$input['description'] = "Paid Remaing Balance";
					$input['amount'] = $difference;
					$input['booking_id'] = $booking->id;
					$additonaltransaction = AdditionalTransaction::create($input);
					
					if($additonaltransaction)
					{
						$booking->payment_status = "Fully Paid";
						$booking->save();

						return back()->withSuccess("You have successfully added new transaction");
					}
				}else
				{
					$booking->payment_status = "Fully Paid";
					$booking->save();
					return back()->with("errors", array("You have already set this transaction payment status to \"Fully Paid\""));
				}

			}else if($request->has("updateroom"))
			{
				$booked_room_id = $request->get("booked_room_id", "");
				$selected_room_id = $request->get("room_id", "");
				$booked_room1 = BookedRoom::whereId($booked_room_id)->first();
				if($booked_room1)
				{
					$booked_room1->room_id =$selected_room_id;
					$booked_room1->save();
					return back()->withSuccess("You have successfully updated the room number on this booking.");
				}
			}

		}
		return abort(404);
	}
	public function bookingDate(DateRequest $request)
	{
		$input = $request->all();	
		$input['uniqid'] = uniqid(); 

		$input['check_in'] = $input['check_in']." 14:00";
		$input['check_out'] = $input['check_out']." 12:00";
		$booked_rooms = BookedRoom::with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out'])->get();
		$booked_rooms_arr = array();
		foreach($booked_rooms as $br)
		{
			if(!is_null($br->room_id) && $br->bookingDetails->booking_status!="cancelled") 
				array_push($booked_rooms_arr, $br->room_id);
		}
		$session = array();
		$session['check_in'] = $input['check_in'];
		$session['check_out'] = $input['check_out'];
		$session['booked_rooms_arr'] = $booked_rooms_arr;
		$this->putDbSession($session, $request);
		$available_rooms = RoomType::with(array("rooms"=>function($query) use ($booked_rooms_arr)
		{
			$query->whereNotIn("id", $booked_rooms_arr)->where("target_booking", "walk-in");
		},'rooms.details','rooms.details.mealPlans'))->get();

		foreach($available_rooms as $key=>$ar)
		{
			$booked_rooms = BookedRoom::where("room_type_id", $ar->id)->with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out']);
			$booked_rooms_arr = array();
			if($booked_rooms->count() >0)
			{
				foreach($booked_rooms->get() as $br)
				{
					if($br->room_id == $input['room_id'] && $br->bookingDetails->booking_status != "cancelled")
					{
						unset($available_rooms[$key]);
					}
					if($booked_rooms->count() > $br->roomTypeDetails->quantity)
					{
						unset($available_rooms[$key]);
					}
				}
			}
		}
		

		return $available_rooms;
	}

	public function bookingRemoveRoom(Request $request)
	{
		$id = $request->get("id", 0);
		$session = $this->getDbSession($request);
		$session = json_decode($session, true);
		$tmp_booked_room = $session['booked_room_details'];
		$tmp_customer_booked_room = $session['customer_booked_room'];
		foreach ($tmp_booked_room as $key => $brd) {
			if($brd['room_id'] == $id)
			{
				unset($tmp_booked_room[$key]);	
			}
		}

		foreach($tmp_customer_booked_room as $key=>$cbr)
		{
			if($cbr['room_id'] == $id)
			{
				//return "Test";
				unset($tmp_customer_booked_room[$key]);
			}
		}

		//return $tmp_customer_booked_room;
		$session['booked_room_details'] = $tmp_booked_room;
		$session['customer_booked_room'] = $tmp_customer_booked_room;
		$this->putDbSession($session, $request);
		$input['check_in'] = $session['check_in'];
		$input['check_out'] = $session['check_out'];
		$booked_rooms = BookedRoom::with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out'])->get();
		$booked_rooms_arr = array();
		//return $session['customer_booked_room'];
		foreach($session['booked_room_details'] as $cbr)
		{
			array_push($booked_rooms_arr, $cbr['room_id']);
		}

		
		foreach($booked_rooms as $br)
		{

			if(!is_null($br->room_id) && $br->bookingDetails->booking_status!="cancelled") 
				array_push($booked_rooms_arr, $br->room_id);
		}
		$available_rooms = RoomType::with(array("rooms"=>function($query) use ($booked_rooms_arr)
		{
			$query->whereNotIn("id", $booked_rooms_arr);
		},'rooms.details','rooms.details.mealPlans'))->get();
		return $available_rooms;
	}
	public function tempRooms(BookingRoomsRequest $request)
	{
		return $return;
	}

	public function bookingDetails(Request $request)
	{

		if($request->ajax())
		{
			// initialize website settings
			$websitesetting = WebsiteSetting::first();

			//get pre created sessions
			$session = $this->getDbSession($request);
			$session = json_decode($session, true);
			$check_in = Carbon::parse($session['check_in']);
			$check_out = Carbon::parse($session['check_out']);
			$nights = $check_out->diffInDays($check_in);
			
			$total_price = 0;
			$customer_booked_room = ((isset($session['customer_booked_room']))) ? $session['customer_booked_room'] : array();
			$session['customer_booked_room'] = $customer_booked_room;
			if($websitesetting)
			{
				$session['tax'] = $websitesetting->tax;
			}
			$session['sub_total_price'] = 0;
			$session['total_price'] = 0;
			$session['test'] = 0;
			$session['test2'] = array();
			if(empty($session['customer_booked_room']))
			{
				return $session;
			}

			$booked_room = array();
			foreach($session['customer_booked_room'] as $cbr)
			{
				$check_in_tmp = $check_in;
				$check_out_tmp = $check_out;
				$counter = 0;	
				$roomtype = RoomType::where("id",$cbr['room_type_id'])->with("mealPlans")->first();
				if($roomtype)
				{

					$roomtype_tmp = array();
					$roomtype_tmp['uniqid'] = uniqid();
					$roomtype_tmp['room_id'] = $cbr['room_id'];
					$roomtype_tmp['room_type_id'] = $cbr['room_type_id'];
					$roomtype_tmp['name'] = $roomtype->name;
					$roomtype_tmp['children'] = $cbr['children'];
					$roomtype_tmp['adult'] = $cbr['adult'];
					$roomtype_tmp['food'] = $cbr['food'];
					$roomtype_tmp['room_price'] = 0;
					$roomtype_tmp['food_price'] = 0;
					$tmp_price = array();
					$tmp = array();
					while($counter <= $nights)
					{
						$price_calendar = PricingCalendar::availability($check_in_tmp,$check_in_tmp)->first();
						if($price_calendar)
						{
							array_push($tmp_price, (int) $price_calendar->price);
						}else
						{
							switch($check_in_tmp->dayOfWeek)
							{
								case 0:
							//$roomtype_tmp['room_price'] += (int) $roomtype->displayPriceSunday;
								array_push($tmp_price, (int) $roomtype->displayPriceSunday);
								break;

								case 1:
							//$roomtype_tmp['room_price'] += (int) $roomtype->displayPriceMonday;
								array_push($tmp_price, (int) $roomtype->displayPriceMonday);
								break;

								case 2:
							//$roomtype_tmp['room_price'] += (int) $roomtype->displayPriceTuesday;
								array_push($tmp_price, (int) $roomtype->displayPriceTuesday);
								break;

								case 3:
							//$roomtype_tmp['room_price'] += (int) $roomtype->displayPriceWednesday;
								array_push($tmp_price, (int) $roomtype->displayPriceWednesday);
								break;

								case 4:
							//$roomtype_tmp['room_price'] += (int) $roomtype->displayPriceThursday;
								array_push($tmp_price, (int) $roomtype->displayPriceThursday);
								break;

								case 5:
							//$roomtype_tmp['room_price'] += (int) $roomtype->displayPriceFriday;
								array_push($tmp_price, (int) $roomtype->displayPriceFriday);
								break;

								case 6:
							//$roomtype_tmp['room_price'] += (int) $roomtype->displayPriceSaturday;
								array_push($tmp_price, (int) $roomtype->displayPriceSaturday);
								break;

								default:
							//$roomtype_tmp['room_price'] += (int) $roomtype->base_price;
								array_push($tmp_price, (int) $roomtype->base_price);
								break;
							}
						}
						

						//array_push($tmp, $roomtype_tmp['room_price']);
						
						$roomtype_tmp['room_price'] = number_format($roomtype_tmp['room_price'],2);
						$tmp_food_price = 0;
						if(!empty($roomtype->mealPlans))
						{
							//return $roomtype->mealPlans;
							$tmp_food_price = $roomtype->mealPlans->price * (int) $cbr['food'];

							
						}
						$check_in_tmp = $check_in_tmp->addDay();
						$counter++;

					}
					foreach($tmp_price as $price)
					{
						$roomtype_tmp['room_price'] += $price;
					}

					$session['sub_total_price'] +=  $tmp_food_price	 + $roomtype_tmp['room_price'];
					$roomtype_tmp['food_price'] = number_format($tmp_food_price, 2);
					$roomtype_tmp['room_price'] = number_format($roomtype_tmp['room_price'],2);	
					array_push($booked_room, $roomtype_tmp);
				}
			}
			
			$session['tax_price'] = number_format((((int) $session['tax'] / 100) * $session['sub_total_price']),2);
			$session['total_price'] = number_format((((int) $session['tax'] / 100) * $session['sub_total_price']) + $session['sub_total_price'],2);
			$session['booked_room_details'] = $booked_room;
			$session['sub_total_price'] = number_format($session['sub_total_price'],2);
			$this->putDbSession($session, $request);
			return $session;
		}
		return response("You are not authorized to access this page.", 403);
		
	}

	public function bookingReset(Request $request)
	{
		$this->putDbSession([], $request);
	}

	public function addBookedRoom(Request $request)
	{
		$input = $request->all();
		$session = $this->getDbSession($request);
		$session = json_decode($session,true);

		if(isset($session["customer_booked_room"]))
		{
			if(count($session["customer_booked_room"]) >= 5){
				return response("You have already reached the maximum number of rooms per booking.",500);
			}
		}


		$children = (int) $input['children'];
		$adult = (int) $input['adult'];
		if(($children+$adult) < 1)
		{
			return response("Invalid number of Capacity",502);
		}


		$input['check_in'] = $session['check_in'];
		$input['check_out'] = $session['check_out'];
		
		$booked_rooms = BookedRoom::where("room_type_id", $input['room_type_id'])->with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out']);
		$booked_rooms_arr = array();

		if($booked_rooms->count() >0)
		{
			foreach($booked_rooms->get() as $br)
			{
				if($br->room_id == $input['room_id'] && $br->bookingDetails->booking_status != "cancelled")
					response("The room is not available..",502);

				if($booked_rooms->count() > $br->roomTypeDetails->quantity)
					return $br->roomTypeDetails->quantity;
				return response("The room is not available...",502);
			}
		}
		$tmp_customer_booked_room = (isset($session["customer_booked_room"])) ? $session["customer_booked_room"] : array();

		array_push($tmp_customer_booked_room, $input);
		$session["customer_booked_room"] = $tmp_customer_booked_room;
		$this->putDbSession($session, $request);
		return $session;
	}

	public function bookingRooms(Request $request)
	{
		$session = $this->getDbSession($request);
		$session = json_decode($session);
		$available_rooms = RoomType::with(array("mealPlans","rooms"=>function($query) use ($session)
		{
			$query->whereNotIn("id", $session->booked_rooms_arr);
		}))->get();
		return $available_rooms;
	}
}
