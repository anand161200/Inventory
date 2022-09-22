<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleFromRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'role' => 'required|unique:roles,name,'.$this->id,
        ];
    }

    public function getRequestFiled()
    {
        return [
            'name'=>$this->role,
        ];
    }
}
