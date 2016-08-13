<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PricingCalendarRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	if(\Auth::guest())
        return false;
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
        "title" => "required",
        "description" => "required",
        "from" => "required|date",
        "to" => "required|date|after:from",
        "price" => "required|numeric",
        "status" =>"boolean",
        "target" => "required|numeric|exists:room_type,id",
        
        ];
    }
}
