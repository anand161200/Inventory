<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFromRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'Gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'phoneNumber' => 'required|numeric',
            'password' => 'required',
            'cofirm_password' => 'required|same:password',
        ];
    }
}
