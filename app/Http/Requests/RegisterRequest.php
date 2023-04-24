<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;





class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;

    }


    public function rules()
    {
        return [
            'name' =>'required|string',
            'DOB'=>'date|date_format:Y-m-d',
            'email' =>'required|string|unique:users,email',
            'phone'=>'required|string',
            'location'=>'required|string',
            'street'=>'required|string',
            'password' =>'required|confirmed',
        ];
    }
}
