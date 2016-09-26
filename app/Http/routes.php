<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\RoomType;
use App\Room;
use App\Booking;
use App\BookedRoom;
use App\BookedRoomType;
use App\Helpers\BookingIdGenerator;
use Illuminate\Support\Facades\Route;



Route::get("redirect", function()
{
	if(Auth::guest())
	{
		return redirect("backend/login");
	}
	
	switch(\Auth::user()->user_type)
	{
		case "admin":
		return Redirect::to("admin");
		break;

		case "housekeeping":
		return redirect("housekeeping");
		break;

		case "frontdesk":
		return redirect("frontdesk");

		default:
		return redirect("backend/login");
	}
});

Route::get("test", function()
{

	$email_data = array();
	$email_data['name'] = "Tan";
	$email_data['reference_number'] = "234243";
					//return $email_data;
	Mail::send('frontend.booking.email', $email_data, function ($message) {
		$message->from('test@filigans.com', 'Admin Filigans');
		$message->to('tan_0300@yahoo.com');
		$message->subject("Filigans Hotel Reservation");
	});


});

Route::get("test1", function(){
	$booking = \App\Booking::all();
	foreach($booking as $key=>$b){
		$b->booking_type ="online";
		$b->save();
	}
});
/*end of test routes*/

/*front end routes*/
Route::get("/", "FrontendController@index");
Route::resource("rooms", "FrontendRoomsController");
Route::resource("promos","FrontendPromoController");
Route::resource("gallery", "FrontendGalleryController");
Route::get("about", "FrontendController@about");
Route::get("contact", "FrontendController@contact");
Route::post("booking/date", "FrontendBookingController@bookingDate");
Route::get("booking/details", "FrontendBookingController@bookingDetails");
Route::get("booking/details/reset", "FrontendBookingController@bookingReset");
Route::post("booking/temprooms", "FrontendBookingController@tempRooms");
Route::post("booking/addrooms", "FrontendBookingController@addBookedRoom");
Route::get("booking/details/removeroom", "FrontendBookingController@bookingRemoveRoom");
Route::get("booking/{id}/invoice", "AdminBookingController@viewInvoice");
Route::get("booking/{booking_no}/registration", "FrontendBookingController@viewRegistration");
Route::get("booking/{id}/payment", "FrontendBookingController@viewPayment");
Route::post("booking/{id}/payment", "FrontendBookingController@postPayment");
Route::get("booking/success", "FrontendBookingController@callbackSuccess");
Route::get("booking/fail", "FrontendBookingController@callbackFail");
Route::get("booking/cancel", "FrontendBookingController@callbackCancel");
Route::get("booking/datafeed", "FrontendBookingController@callbackDatafeed");
Route::post("booking/datafeed", "FrontendBookingController@callbackDatafeed");
Route::resource("booking", "FrontendBookingController");



/*end of front end routes*/

/*admin routes*/
Route::get('backend/login', ['middleware'=>'IsLoggedIn','uses'=>'AdminController@viewLogin']);
Route::post('backend/login', ['middleware'=>'IsLoggedIn', 'uses' =>'AdminController@checkLogin']);

Route::group(array('prefix'=>'housekeeping'), function()
{
	Route::get("/", "HouseKeepingController@index");
	Route::get("rooms", "HouseKeepingController@index");
});


Route::group(array('prefix'=>'admin', 'middleware'=>'adminauth'), function()
{
	/*get request*/
	Route::get("/","AdminController@index");	
	Route::get("settings/about", "AdminSettingsController@showAbout");
	Route::get("settings/contact", "AdminSettingsController@showContact");
	Route::get("settings/tax", "AdminSettingsController@showTax");
	Route::get("settings/terms-condition", "AdminSettingsController@showTerms");
	Route::get("users/myprofile", "AdminUserController@showMyProfile");
	Route::get("users/myprofile/account", "AdminUserController@showMyAccount");
	Route::get("rooms/type/{id}/delete","AdminRoomTypeController@delete");
	Route::get("rooms/{id}/delete", "AdminRoomsController@delete");
	Route::get("booking/rooms", "AdminBookingController@bookingRooms");
	Route::get("booking/step2", "AdminBookingController@bookingStep2");
	Route::get("booking/details", "AdminBookingController@bookingDetails");
	Route::get("booking/details/reset", "AdminBookingController@bookingReset");
	Route::get("booking/details/removeroom", "AdminBookingController@bookingRemoveRoom");
	Route::get("customers/search", "AdminCustomerController@searchCustomer");
	Route::get("booking/{booking_no}/registration", "AdminBookingController@viewRegistration");
	Route::get("booking/{id}/invoice", "AdminBookingController@viewInvoice");
	/*patch request*/
	Route::patch("users/myprofile/account", "AdminUserController@updateMyProfile");

	/*post request*/
	Route::post("booking/date", "AdminBookingController@bookingDate");
	Route::post("booking/addrooms", "AdminBookingController@addBookedRoom");
	Route::post("booking/temprooms", "AdminBookingController@tempRooms");
	Route::post("booking/filter", "AdminBookingController@bookingFilter");
	Route::post("booking/additionaltransaction", "AdminBookingController@storeAdditionalTransaction");
	/*resources*/
	
	Route::resource("rooms/meal-plans", "AdminMealPlansController");
	Route::resource("rooms/features", "AdminRoomFeaturesController");
	Route::resource("rooms/type", "AdminRoomTypeController");
	Route::resource("rooms", "AdminRoomsController");
	Route::resource("booking", "AdminBookingController");
	Route::resource("pricing-calendar", "AdminPricingCalendarController");
	Route::resource("customers", "AdminCustomerController");
	Route::resource("settings/gallery", "AdminGalleryController");
	Route::resource("settings", "AdminSettingsController");
	Route::resource("users", "AdminUserController");
	Route::resource("reports", "AdminReportsController");
});

/*end of admin*/



Route::get("phpinfoko", function(){
	phpinfo();
});

