<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBookingRequest extends Request
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
            "booked_room_details" => "required",
            "check_in" => "required|date",
            "check_out" => "required|date",
            "total_price" => "required",
            "amount_paid" => "required"
        ];
    }
}
