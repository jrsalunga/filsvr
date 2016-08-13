<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PricingCalendar;
use App\Http\Requests\PricingCalendarRequest;

use App\Http\Requests;

class AdminPricingCalendarController extends Controller
{
	public function index(Request $request)
	{
		if($request->ajax())
		{
			$order = $request->input("order","desc");
			$sort = $request->input("sort", "created_at");
			$take = $request->input("limit",10);
			$skip = $request->input("offset", 0);
			$search = $request->input("search", "");

			$pricing_calendar = PricingCalendar::where("title", "LIKE", "%$search%")
			->orWhere("description", "LIKE", "%$search%")
			->orWhere("from", "like", "%$search%")
			->orWhere("to","like", "%$search%")
			->orderBy($sort,$order);

			$output = array();

			$output['total'] = $pricing_calendar->count();
			$output['rows'] = $pricing_calendar->skip($skip)->take($take)->get();
			return $output;
		}
		return view("admin.pricing_calendar.index");
	}


    /**
     * Store a natcasesort(array)ewly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PricingCalendarRequest $request)
    {
    	$input = $request->all();
    	$pricing_calendar = PricingCalendar::create($input);
    	return back()->withSuccess("You have successfully created a new Pricing Calendar");
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$roomtype = \App\RoomType::all();
    	return view("admin.pricing_calendar.create", compact("roomtype"));
    }

    public function edit($id)
    {
    	try
    	{
    		$roomtype = \App\RoomType::all();
    		$pricing_calendar = PricingCalendar::findOrFail($id);

    		return view("admin.pricing_calendar.update", compact("pricing_calendar", "roomtype"));
    	}
    	catch(Exception $e)
    	{
    		return abort(404);
    	}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PricingCalendarRequest $request, $id)
    {
    	$input = $request->all();
    	$input['status'] = $request->get("status", 0);

    	$pricing_calendar= PricingCalendar::findOrFail($id);
    	if($pricing_calendar)
    	{
    		$pricing_calendar->update($input);
    	return back()->withSuccess("You have successfully updated Pricing Calendar");
    	}
    	
    }


    public function destroy($id)
    {
    	$pricing_calendar = PricingCalendar::whereId($id)->first();
    	if($pricing_calendar)
    	{
    		$pricing_calendar->delete();
    	}
    }
}
