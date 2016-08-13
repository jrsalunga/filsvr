<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddRoom extends Request
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
          'room_type' => "required|numeric|exists:room_type,id",
          'room_no' => "alpha_num|min:3|unique:rooms,room_no",
          'view' => "alpha_num|min:3"
        ];
    }
}
