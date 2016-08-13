<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FrontendPromoController extends Controller
{
	public function __construct(Request $request)
	{
		$request->session()->flash('current_page', 'promos');
	}
	public function index()
	{
		//$promo = Promo::where("2016")
		return view("frontend.promo.index");
	}
}
