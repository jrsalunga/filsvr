<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
	protected $table = "website_settings";
	protected $fillable = array("about","email","google_map", "contact_no","terms_and_condition","logo", "tax");
}
