<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FilterBookingRequest extends Request
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
            "filter" => "required|numeric",
            "filter_date" => "date"
        ];
    }
}
