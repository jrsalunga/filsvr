<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateRoomType extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Auth::guest())
        {
            return false; 
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        "name" => "required",
        "short_description" => "required|max:255",
        "full_description" => "required",
        "max_adult" => "required|numeric",
        "max_children" => "required|numeric",
        "beds" => "required|numeric",
        "room_area" => "required|numeric",
        "base_price" => "required|numeric",
        "meal_plan" => "exists:meal_plans,id",
        "picture" => "mimes:jpg,jpeg,bmp,png",
        "price_monday" => "numeric",
        "price_tuesday" => "numeric",
        "price_wednesday" => "numeric",
        "price_thursday" => "numeric",
        "price_friday" => "numeric",
        "price_saturday" => "numeric",
        "price_sunday" => "numeric",

        ];
    }
}
