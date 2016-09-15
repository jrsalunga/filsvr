<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FrontendCreateBookingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            "booked_room_details" => "required",
            "check_in" => "required|date",
            "check_out" => "required|date",
            "total_price" => "required",
            "email" => "required|email",
            "lastname" => "required",
            "firstname" => "required",
            "birthday" => "required|date",
            "nationality" => "required",
            "phone_number" => "required",
           
        ];
    }
}
