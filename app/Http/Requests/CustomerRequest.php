<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
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
        if(Request::isMethod('post'))
        {
            return [
            "firstname" => "alpha|required|min:2",
            "lastname" => "alpha|required|min:2",
            "contact_no" =>"required|min:4",
            "email" => "email",
            "address" => "required",
            "birthday" =>"required|date",
            ];
        }else
        {
            $id = Request::get("id");
            return [
            "firstname" => "alpha|required|min:2",
            "lastname" => "alpha|required|min:2",
            "contact_no" =>"required|min:4",
            "email" => "required|email|unique:customers,email,".$id,
            "birthday" => "required|date"
            ];
        }
        
    }
}
