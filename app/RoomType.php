<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use \DB;
use \Carbon;
use App\Helpers\BookingIdGenerator;

class RoomType extends Model
{
	use Sluggable;
//
	protected $total_price;
	protected $table = 'room_type';
	protected $fillable = ["name","picture", "short_description","description", "max_adult",
	"max_children","beds","room_area","meal_plan","base_price", "price_monday", "price_tuesday", "price_wednesday", "price_thursday", "price_friday", "price_saturday",	'max_online_booking'];
	
	protected $appends = array("room_count","quantity",
		"display_price", 
		"display_price_monday",
		"display_price_tuesday",
		"display_price_wednesday",
		"display_price_thursday",
		"display_price_friday",
		"display_price_saturday",
		"display_price_sunday"
		
		);	
	
	public function sluggable()
	{
		return [
		'slug' => [
		'source' => 'name'
		]
		];
	}

	public function rooms()
	{
		return $this->hasMany("App\Room", "room_type_id", "id");
	}

	public function mealPlans()
	{
		return $this->hasOne("App\MealPlan", "id", "meal_plan");
	}

	public function getDisplayPriceMondayAttribute()
	{
		$price = (is_numeric($this->price_monday) && $this->price_monday > 0) ? $this->price_monday : $this->base_price;
		return number_format($price);
	}

	public function getDisplayPriceTuesdayAttribute()
	{
		$price = (is_numeric($this->price_tuesday) && $this->price_tuesday > 0) ? $this->price_tuesday : $this->base_price;
		return number_format($price);
	}

	public function getQuantityAttribute()
	{
		$rooms = Room::where("room_type_id", $this->id)->count();
		return $rooms;
	}

	public function displayPrice($date)
	{
		$dt = Carbon::parse($date);
		switch($dt->dayOfWeek)
		{
			case 0:
			return $this->getDisplayPriceSundayAttribute;
			break;

			case 1:
			return $this->getDisplayPriceMondayAttribute;
			break;

			case 2:
			return $this->getDisplayPriceTuesdayAttribute;
			break;

			case 3:
			return $this->getDisplayPriceWednesdayAttribute;
			break;

			case 4:
			return $this->getDisplayPriceThursdayAttribute;
			break;

			case 5:
			return $this->getDisplayPriceFridayAttribute;
			break;

			case 6:
			return $this->getDisplayPriceSaturdayAttribute;
			break;

			default:
			return $this->base_price;
			break;
		}
	}
	public function getDisplayPriceWednesdayAttribute()
	{
		$price = (is_numeric($this->price_wednesday) && $this->price_wednesday > 0) ? $this->price_wednesday : $this->base_price;
		return number_format($price);
	}
	public function getDisplayPriceThursdayAttribute()
	{
		$price = (is_numeric($this->price_thursday) && $this->price_thursday > 0) ? $this->price_thursday : $this->base_price;
		return number_format($price);
	}
	public function getDisplayPriceFridayAttribute()
	{
		$price = (is_numeric($this->price_friday) && $this->price_friday > 0) ? $this->price_friday : $this->base_price;
		return number_format($price);
	}
	
	public function getDisplayPriceSaturdayAttribute()
	{
		$price = (is_numeric($this->price_saturday) && $this->price_saturday > 0) ? $this->price_saturday : $this->base_price;
		return number_format($price);
	}

	public function getDisplayPriceSundayAttribute()
	{
		$price = (is_numeric($this->price_sunday) && $this->price_sunday > 0) ? $this->price_sunday : $this->base_price;
		return number_format($price);
	}

	public function getDisplayPriceAttribute()
	{
		$counter = 0;
		$total_price = 0;
		$total_price = $this->displayPriceMonday
		+$this->displayPriceTuesday
		+$this->displayPriceWednesday
		+$this->displayPriceThursday
		+$this->displayPriceFriday
		+$this->displayPriceSaturday
		+$this->displayPriceSunday;	
		return number_format($total_price/7,2);
	}

	public function getRoomCountAttribute()
	{
		$count = Room::where("room_type_id", $this->id)->where("status","available")->count();
		return $count;
	}
	
	public function dayPrice($date=null)
	{

		if($date==null)
		{
			return $this->base_price;
		}
		$date = Carbon::parse($date);
		switch($date->dayOfWeek)
		{
			case 0:	
			return (is_numeric($this->sunday_price)) ? $this->sunday_price : $this->base_price;
			break;

			case 1:	
			return (is_numeric($this->monday_price)) ? $this->monday_price : $this->base_price;
			break;

			case 2:	
			return (is_numeric($this->tuesday_price)) ? $this->tuesday_price : $this->base_price;
			break;

			case 3:	
			return (is_numeric($this->wednesday_price)) ? $this->wednesday_price : $this->base_price;
			break;

			case 4:	
			return (is_numeric($this->thursday_price)) ? $this->thursday_price : $this->base_price;
			break;

			case 5:	
			return (is_numeric($this->friday_price)) ? $this->friday_price : $this->base_price;
			break;

			case 6:	
			return (is_numeric($this->saturday_price)) ? $this->saturday_price : $this->base_price;
			break;

			default:
			return $this->base_price;

		}
	}

	public function booking()
	{
		return $this->hasMany("App\Booking", "room_type_id", "id");
	}

	public function features()
	{
		return $this->hasMany("App\RoomFeature", "room_type_id", "id");
	}

	/*mutators==========*/
	public function setIdAttribute($value)
	{
		$this->id = new BookingIdGenerator("F");
	}

	/*accerors===========*/

	public function getPictureAttribute($value)
	{
		if($value == "" || empty($value) || $value==null) return "no-preview-available.png";
		return $value;
	}
}