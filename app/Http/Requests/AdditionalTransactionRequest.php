<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdditionalTransactionRequest extends Request
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
            "reference_no" => "min:4",
            "description" => "required|min:5",
            "amount" => "required|numeric",
            "booking_id" => "required|numeric"
        ];
    }
}
