<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        if (Request::is('admin/users/myprofile/account')) {
            return[
            "username" => "required|min:2|unique:users,username,".\Auth::id(),
            "password" => "confirmed|min:2",
            ];
        }

        else if (Request::is('admin/users/myprofile')) {
            return [
            "firstname" => "required|alpha|min:2",
            "lastname" => "required|alpha|min:2",
            "email" => "required|email|unique:users,email,".\Auth::id()
            ];

        }
        else if (Request::is('admin/users')) {
           return [
           "username" => "required",
           "firstname" => "required|alpha|min:2",
           "lastname" => "required|alpha|min:2",
           "email" => "required|email|unique:users,email",
           "user_type" => "required|unique:users,email"
           ];

       }
   }
}
