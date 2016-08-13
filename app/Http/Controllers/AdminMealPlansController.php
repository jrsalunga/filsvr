<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MealPlan;
use App\Http\Requests;
use App\Http\Requests\MealPlanRequest;

class AdminMealPlansController extends Controller
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

			$feature = MealPlan::where("name", "LIKE", "%$search%")
			
			->orderBy($sort, $order);

			$output = array();
			$output['total'] = $feature->count();
			$output['rows'] = $feature->take($take)->skip($skip)->get();
			return $output;
		}
		return view("admin.rooms.meal_plans");
	}

	public function create()
	{
		return view("admin.rooms.create_meal_plans");
	}

	public function store(MealPlanRequest $request)
	{
		try
		{
			$mealplan = MealPlan::create($request->all());
			return back()->withSuccess("You have successfully created a new meal plan");
		}catch(Exception $e)
		{
			return back()->withErrors(['Problem saving to database. Please try again.']);
		}
		return $request->all();
	}

	public function edit($id)
	{
		$meal_plan = MealPlan::findOrFail($id);
		return view("admin.rooms.update_meal_plans", compact("meal_plan"));
	}

	public function update($id, MealPlanRequest $request)
	{
		$meal_plan = MealPlan::findOrFail($id);
		$meal_plan->update($request->all());
		return back()->withSuccess("You have successfully updated this meal plan");
	}	
	public function destroy($id)
	{
		MealPlan::destroy($id);
	}
}
