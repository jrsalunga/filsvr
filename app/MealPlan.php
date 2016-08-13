<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
   protected $table = "meal_plans";
   protected $fillable = array("name", "price");
   protected $appends = array("display_name");

   public function getDisplayNameAttribute()
   {
   		return $this->name." | P ".number_format($this->price);
   }
}
