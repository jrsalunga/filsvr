<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Promo extends Model
{
	use Sluggable;
    protected $fillable = ["name", "description", "from", "to", "effect", "status"];
    public function sluggable()
	{
		return [
		'slug' => [
		'source' => 'name'
		]
		];
	}

}
