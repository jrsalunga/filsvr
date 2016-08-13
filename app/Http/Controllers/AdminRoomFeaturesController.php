<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoomFeatures;
use App\Http\Requests;
use App\Feature;

class AdminRoomFeaturesController extends Controller
{
	public function index(Request $request)
	{
		if($request->ajax())
		{
			$order = $request->input("order","desc");
			$sort = $request->input("sort", "created_at");
			$take = $request->input("limit",10);
			$skip = $request->input("offset", 0);
			$search = $request->input("search","");

			$feature = Feature::where("name", "LIKE", "%$search%")
			->take($take)->skip($skip)
			->orderBy($sort, $order)
			->get();

			$output = array();
			$output['total'] = $feature->count();
			$output['rows'] = $feature;
			return $output;
		}
		return view("admin.rooms.features");
	}

	public function update($id, RoomFeatures $request)
	{
		$input = $request->all();
		try
		{
			$input = $request->all();
			$feature = Feature::find($id);
			$feature->name = $input['name'];
			$feature->save();
			return $feature->name;
		}
		catch(Exception $e)
		{
			return "Error saving to database.";
		}
	}

	public function destroy($id)
	{
		Feature::destroy($id);
	}
	public function store(RoomFeatures $request)
	{	
		try
		{
			$input = $request->all();
			$feature = new Feature;
			$feature->name = $input['name'];
			$feature->save();
		}
		catch(Exception $e)
		{

		}
	}
}
