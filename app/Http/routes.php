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
use \Carbon;
use \Calendar;
use \PDF;


Route::get("test", function()
{
	$var1 = (1<<0);
	$var2 = (1<<2);
	$var3 = (1<<3);
	$var4 = (1<<4);
	$var5 = (1<<5);

	$test1 = ($var1|$var2);
	$test2 = ($var1|$var2|$var3);
	$test3 = ($var2|$var3|$var4);
	$test4 = ($var1|$var4|$var5);
	if($test1 & $test2)
	{
		echo "they have intersected <br>
		<b> $test1 $test2</b>";
	}

	if($test1 & $test4)
	{
		echo "They are completely the same <br>";
	}

	if(5 & 14)
	{
		echo "yes! <br>";
	}

});
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

/*end of test routes*/

/*front end routes*/
Route::get("/", "FrontendController@index");
Route::resource("rooms", "FrontendRoomsController");
Route::resource("promos","FrontendPromoController");
Route::resource("gallery", "FrontendGalleryController");
Route::get("about", "FrontendController@about");
Route::get("contact", "FrontendController@contact");
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

