<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class PricingCalendar extends Model
{
	use Sluggable;
    protected $fillable = ["title", "description", "from", "to", "price", "status","target"];
    public function sluggable()
	{
		return [
		'slug' => [
		'source' => 'title'
		]
		];
	}

	public function scopeAvailability($query, $check_in, $check_out)
	{
		return $query->whereBetween('from', array($check_in, $check_out))
		->orWhereBetween('to', array($check_in, $check_out))
		->orWhereRaw('"'.$check_in.'" between `from` and `to`')
		->orWhereRaw('"'.$check_out.'" between `from` and `to`');
	}


}
