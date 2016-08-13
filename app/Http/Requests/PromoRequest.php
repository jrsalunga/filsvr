<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PromoRequest extends Request
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
        "description" => "required",
        "from" => "required|date",
        "to" => "required|date|after:from",
        "effect" => "required|numeric",
        "status" =>"boolean",
        "target"=>"required"
        ];
    }
}
