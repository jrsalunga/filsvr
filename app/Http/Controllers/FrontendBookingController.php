<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\FrontendDateRequest;
use App\Http\Requests;
use App\Booking;
use App\PricingCalendar;
use App\BookedRoom;
use App\RoomType;
use App\SessionBooking;
use App\Http\Requests\BookingRoomsRequest;
use Carbon\Carbon;
use \PDF;
use \Auth;
use App\AdditionalTransaction;
use App\Http\Requests\AdditionalTransactionRequest;
use App\Http\Requests\FilterBookingRequest;
use App\Http\Requests\FrontendCreateBookingRequest;
use App\WebsiteSetting;
use App\Customer;
use Mail;
use Log;
use Exception;

class FrontendBookingController extends Controller
{


	public function __construct() {
			}

	public function putDbSession($content_array, $request)
	{
		$session = SessionBooking::firstOrCreate(['ip_address' => $request->ip()]);
		$session->content = json_encode($content_array);
		$session->save();
	}


	public function getDbSession(Request $request)
	{
		$session = SessionBooking::firstOrCreate(['ip_address' => $request->ip()]);
		return $session->content;
	}

	public function update($id, Request $request)
	{
		//\Session::put('_token', sha1(microtime()));
		$input = $request->all();
		$booking = Booking::with('additionalTransaction')->whereId($id)->first();
		$customer = null;
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
				}else if(strtolower($input['booking_status']) == "cancelled")
				{
					if(!$request->has("sure"))
					{
						return back()->withCancelled("Are you sure you want to cancel this booking? ");
					}
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

	public function viewRegistration($booking_no)
	{
		$booking = \App\Booking::where("booking_no", $booking_no)->with("customer","rooms.roomTypeDetails")->first();
		if($booking)
		{
		//	return $booking;
			return view("admin.booking.registration", compact("booking"));


		}
	}

	public function store(FrontendCreateBookingRequest $request)
	//public function store(Request $request)
	{
		$input = $request->all();
		$session = $this->getDbSession($request);
		$session = json_decode($session, true);

		$total_price = intval(preg_replace('/[^\d.]/', '', $input['total_price']));
		$amount_paid =(int) $request->get("amount_paid", "0");
		$difference = $total_price - $amount_paid;
		$payment_status = ($difference > 1) ? "Partially Paid" : "Fully Paid";
		$payment_status = ($amount_paid == 0) ? "N/A" : $payment_status;
		$tmparr = array();
		$customer = null;
		$booking = null;
		
		foreach($input['booked_room_details'] as $brd)
		{
			array_push($tmparr,$brd['room_id']);
		}


		$booked_rooms = BookedRoom::whereIn('room_id',$tmparr)->with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out'])->get();

		if($booked_rooms->count() >0)
		{
			foreach($booked_rooms->get() as $br)
			{
				if($br->room_id == $input['room_id'] && $br->bookingDetails->booking_status != "cancelled")
					return response("The room is not available..",502);

				if(($booked_rooms->count() + count($session["customer_booked_room"])) > $br->roomTypeDetails->quantity)
					return response("The room is not available...",502);
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
				$customer_input = array();
				$customer_input['firstname'] = $input['firstname'];
				$customer_input['lastname'] = $input['lastname'];
				$customer_input['email'] = $input['email'];
				$email = $customer_input['email'];
				$customer_input['address'] = $input['address'];
				$customer_input['flight_details'] = $input['flight_details'];
				$customer_input['contact_no'] = $input['phone_number'];
				$customer_input['birthday'] = $input['birthday'];
				$customer_input['nationality'] = $input['nationality'];

				$customer = Customer::where("email", "like", "%$email%")->first();
				
				if(!$customer)
				{
					//$customer;
					$customer = Customer::create($customer_input);
				}
				$booking_input = array();
				$booking_input['booking_no'] = uniqid();
				$booking_input['total_price'] =intval(preg_replace('/[^\d.]/', '', $input['total_price']));
				$booking_input['customer_id'] = $customer->id;
				$booking_input['payment_status'] = $payment_status;
				$booking_input['payment_mode'] = "Credit Card";
				$booking_input['booking_status'] = "pending";
				$booking_input['booking_type'] = "online";
				$booking_input['flight_details'] = $input['flight_details'];
				$booking_input['cashier'] = Auth::user()->firstname." ".Auth::user()->lastname;
				$booking = Booking::create($booking_input);
				if($booking)
				{
					
					
					foreach($input['booked_room_details'] as $brd){
						$booked_room_input = array();
						$booked_room_input['booking_id'] = $booking->id;
						$booked_room_input['check_in'] = $input['check_in'];
						$booked_room_input['check_out'] = $input['check_out'];
						$booked_room_input['num_adults'] = $brd['adult'];
						$booked_room_input['num_children'] = $brd['children'];
						$booked_room_input['room_type_id'] = $brd['room_type_id'];
						//$booked_room_input['room_id'] = $brd['room_id'];
						$booked_room_input['room_price'] = intval(preg_replace('/[^\d.]/', '', $brd['room_price']));
						$booked_room_input['food_price'] = intval(preg_replace('/[^\d.]/', '', $brd['food_price']));

						$booked_room = BookedRoom::create($booked_room_input);
						
					}

					Booking::where('id', $booking->id)->update(['booking_no'=>str_pad($booking->id, 10, "0", STR_PAD_LEFT)]);
					$email_data = array();
					$email_data['name'] = ucfirst($customer->firstname)." ".ucfirst($customer->lastname);
					$email_data['reference_number'] = $booking->booking_no;
					
					/*
					Mail::send('frontend.booking.email', $email_data, function ($message) use ($input){
						$message->from('no-reply@filiganshotel.ph', 'Filigans Hotel Reservation System');
						$message->to($input['email']);
						$message->subject("Filigans Hotel Reservation");
					});
					Mail::send('frontend.booking.email_notifier', $email_data, function ($message) use ($input){
						$message->from('no-reply@filiganshotel.ph', 'Filigans System');
						$message->to('reservations@filiganshotel.ph');
						$message->subject($input['email']." reservation");
					});

					Mail::send('frontend.booking.email_notifier', $email_data, function ($message) use ($input){
						$message->from('no-reply@filiganshotel.ph', 'Filigans System');
						$message->to('fhcpalawan@gmail.com');
						$message->subject($input['email']." reservation");
					});
					*/
					//return redirect('/booking/'.$booking->id.'/payment');
					return response($booking, 200);
					return response("You have successfully store a new booking to database ", 200);
				}
			}catch(Exception $e)
			{
				return response("Something went wrong. Please try again.", 500);
			}
			
		}
	}

	public function viewPayment($id) {
		$booking = Booking::with('customer')->where('id',$id)->where('booking_status', 'pending')->first();
		if(!$booking)
			return abort('404');

		/*
		$email_data = [];
		$email_data['name'] = ucfirst($booking->customer->firstname)." ".ucfirst($booking->customer->lastname);
		$email_data['info'] = '<ul><li>Ref. No.: <strong class="pull-right">'.$booking->booking_no.'</strong></li>';
		$email_data['info'] .= '<li>Check In: <strong class="pull-right">'.Carbon::parse($booking->checkin)->format('D M d, Y h:i A').'</strong></li>';
		$email_data['info'] .= '<li>Check Out: <strong class="pull-right">'.Carbon::parse($booking->checkout)->format('D M d, Y h:i A').'</strong></li>';
		$email_data['info'] .= '<li><em>Room Details:</em></li>';
		$email_data['info'] .= '<ul>';
		foreach($booking->rooms as $room) {
			$email_data['info'] .= '<li>'.$room->roomTypeDetails->name.' - <span class="pull-right">PHP '.number_format($room->room_price,2).'</span></li>';			
		}
		$email_data['info'] .= '</ul>';
		$email_data['info'] .= '<li>Total Amount: <strong class="pull-right">PHP '.number_format($booking->total_price,2).'</strong></li>';
		$email_data['info'] .= '</ul>';

		//return $email_data['info'];

		try {
		
			Mail::send('frontend.booking.email', $email_data, function ($message) use ($booking){
				$message->from('no-reply@filiganshotel.ph', 'Filigans Hotel Reservation System');
				$message->to('freakyash_02@yahoo.com');
				//$message->to($booking->customer->email);
				//$message->subject("New Booking! (".$booking->booking_no.")");
				$message->subject("Booking Confirmed! (".$booking->booking_no.")");
			});
		} catch(Exception $e) {

		}
		*/


		//return $booking->load('rooms.roomTypeDetails');
		return view('frontend.booking.payment', compact('booking'));
	}

	public function postPayment(Request $request, $id) {

		if($id!=$request->input('id'))
			return abort('404');

		$booking = Booking::where('id',$id)->where('booking_status', 'pending')->first();

		if(!$booking)
			return abort('404');

		$booking->payment_status = 'redirected';
		$booking->updated_at = Carbon::now();
		$booking->save();

		if(app()->environment()=='production') {
			$mid = env('BDO_MID');
			$url = env('BDO_URL');
		} else {
			$mid = env('BDO_MID_TEST');
			$url = env('BDO_URL_TEST');
		}

		$url .= '?merchantId='.$mid.'&';
		$url .= 'amount='.$booking->total_price.'&';
		$url .= 'orderRef='.$booking->booking_no.'&';
		$url .= 'currCode=608&';
		$url .= 'lang=E&';
		$url .= 'payMethod=ALL&';
		$url .= 'payType=N&';
		$url .= 'successUrl='.env('BDO_URL_SUCCESS').'&';
		$url .= 'failUrl='.env('BDO_URL_FAIL').'&';
		$url .= 'cancelUrl='.env('BDO_URL_CANCEL');
		//return $url;
		return redirect($url);
	}

	public function callbackSuccess(Request $request)
	{
		if($request->has('Ref')) {
			
			$booking = Booking::where([
				['booking_no', '=', $request->input('Ref')]
				//['booking_status', '<>', 'booked']
			])->first();
			
			if(is_null($booking)) {
				return abort('404');
			} else {

				if($booking->booking_status!=='booked') {
					
					$booking->booking_status = 'booked';
					$booking->booking_type = 'online';
					$booking->payment_status = 'online fully paid';
					$booking->updated_at = Carbon::now();
					$booking->booked_timestamp = Carbon::now();
					$booking->save();

					$email_data = [];
					$email_data['name'] = ucfirst($booking->customer->firstname)." ".ucfirst($booking->customer->lastname);
					$email_data['info'] = '<ul><li>Ref. No.: <strong class="pull-right">'.$booking->booking_no.'</strong></li>';
					$email_data['info'] .= '<li>Check In: <strong class="pull-right">'.Carbon::parse($booking->checkin)->format('D M d, Y h:i A').'</strong></li>';
					$email_data['info'] .= '<li>Check Out: <strong class="pull-right">'.Carbon::parse($booking->checkout)->format('D M d, Y h:i A').'</strong></li>';
					$email_data['info'] .= '<li><em>Room Details:</em></li>';
					$email_data['info'] .= '<ul>';
					foreach($booking->rooms as $room) {
						$email_data['info'] .= '<li>'.$room->roomTypeDetails->name.' - <span class="pull-right">PHP '.number_format($room->room_price,2).'</span></li>';			
					}
					$email_data['info'] .= '</ul>';
					$email_data['info'] .= '<li>Total Amount: <strong class="pull-right">PHP '.number_format($booking->total_price,2).'</strong></li>';
					$email_data['info'] .= '</ul>';

					try {
					
						Mail::send('frontend.booking.email', $email_data, function ($message) use ($booking){
							$message->from('no-reply@filiganshotel.ph', 'Filigans Hotel Reservation System');
							$message->to('freakyash_02@yahoo.com');
							$message->to($booking->customer->email);
							//$message->subject("New Booking! (".$booking->booking_no.")");
							$message->subject("Booking Confirmed! (".$booking->booking_no.")");
						});
					} catch(Exception $e) {

					}
				}
				

				return view('frontend.booking.success', compact('booking'));
			}
		}
		return abort('404');
	}

	public function callbackFail(Request $request) {
		if($request->has('Ref')) {
			$booking = Booking::where('booking_no', $request->input('Ref'))->first();
			$booking->booking_status = 'cancelled';
			$booking->booking_type = 'online';
			$booking->payment_status = 'failed';
			$booking->updated_at = Carbon::now();
			$booking->save();

			return view('frontend.booking.fail', compact('booking'));
		}
		return abort('404');
	}


	public function callbackCancel(Request $request) {

		if($request->has('Ref')) {
			
			$booking = Booking::where([
				['booking_no', '=' ,$request->input('Ref')],
				['booking_status', '<>' ,'cancelled'],
			])->first();

			if(is_null($booking)) {
				return abort('404');
			} else {
				$booking->booking_status = 'cancelled';
				$booking->booking_type = 'online';
				$booking->payment_status = 'cancelled';
				$booking->updated_at = Carbon::now();
				$booking->save();
				
				return view('frontend.booking.cancel', compact('booking'));
			}
		}
		return abort('404');
	}


	public function callbackDatafeed(Request $request) {

		echo 'OK';

		Log::info('callback run via '.$request->method().' method');

		$email_data = [
			'name' => 'jeff',
			'info' => 'Datafeed'
		];
		
		Mail::send('frontend.booking.email', $email_data, function ($message) use ($booking){
			$message->from('no-reply@filiganshotel.ph', 'Datafeed');
			$message->to('freakyash_02@yahoo.com');
			$message->subject('Datafeed recieved');
		});
		
	}

	
	
	public function index(Request $request)
	{
		$check_in = $request->get("check_in");
		$check_out = $request->get("check_out");
		$adult = $request->get("adult","0");
		$children = $request->get("children","0");
		return view("frontend.booking.index", compact("check_in","check_out","adult", "children"));
	}

	public function bookingDate(FrontendDateRequest $request)
	{
		$input = $request->all();	
		$input['uniqid'] = uniqid(); 
		$no_of_adult = (int) $request->get("noOfAdult", 0);
		$no_of_children = (int) $request->get("noOfChildren", 0);
		$total_capacity = ($no_of_children + $no_of_adult);
		if($total_capacity < 1)
			return response("Please input a valid number of capacity", 502);
		$input['check_in'] = $input['check_in']." 14:00";
		$input['check_out'] = $input['check_out']." 12:00";
		$booked_rooms = BookedRoom::with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out'])->get();
		$booked_rooms_arr = array();
		foreach($booked_rooms as $br)
		{
			if(!is_null($br->room_id) && $br->bookingDetails->booking_status!="cancelled") 
				array_push($booked_rooms_arr, $br->room_id);
		}
		$session = $this->getDbSession($request);
		$session = json_decode($session,true);
		if(!$request->has("clearbooking"))
		{
			$session = array();
			$session['check_in'] = $input['check_in'];
			$session['check_out'] = $input['check_out'];
			$session['booked_rooms_arr'] = $booked_rooms_arr;
		}
		
		$session['noOfAdult'] = $no_of_adult;
		$session['noOfChildren'] = $no_of_children;
		$this->putDbSession($session, $request);
		if($session['booked_room_details'])
		{
			foreach($session['booked_room_details'] as $brd1)
			{
				array_push($booked_rooms_arr, $brd1->room_id);
			}
		}

		$available_rooms = RoomType::with(array("rooms"=>function($query) use ($booked_rooms_arr)
		{
			$query->whereNotIn("id", $booked_rooms_arr)->where("target_booking", "online");
		},'rooms.details','rooms.details.mealPlans'))->get();

		foreach($available_rooms as $key=>$ar)
		{

			if($ar->capacity < $total_capacity)
			{
				unset($available_rooms[$key]);
			}else
			{
				//return $ar;
				$ar->capacity;

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
		
		return $available_rooms;
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
			$check_in = Carbon::parse(date("Y-m-d", strtotime($session['check_in'])));

			$check_out = Carbon::parse(date("Y-m-d", strtotime($session['check_out'])));
			$nights = $check_out->diffInDays($check_in);
			$check_in_tmp = $check_in;
			$check_out_tmp = $check_out;
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
				$check_in_tmp = Carbon::parse($cbr["check_in"]);
				$check_out_tmp = $check_out;
				$counter = 1;	
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
					$test = 0;
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

		$adult= (int) $session['noOfAdult'];
		$children = (int) $session['noOfChildren'];
		if(($children+$adult) < 1)
		{
			return response("Invalid number of Capacity",502);
		}

		$input['check_in'] = $session['check_in'];
		$input['check_out'] = $session['check_out'];
		$input['adult'] = $adult;
		$input['children'] = $children;
		$booked_rooms = BookedRoom::where("room_type_id", $input['room_type_id'])->with('roomTypeDetails', 'bookingDetails')->availability($input['check_in'], $input['check_out']);
		$booked_rooms_arr = array();
		if($booked_rooms->count() >0)
		{
			foreach($booked_rooms->get() as $br)
			{
				if($br->room_id == $input['room_id'] && $br->bookingDetails->booking_status != "cancelled")
					return response("The room is not available..",502);

				if(($booked_rooms->count() + count($session["customer_booked_room"])) > $br->roomTypeDetails->quantity)
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
