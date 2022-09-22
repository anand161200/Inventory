<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BrandFromRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules() : array
    {
        $rules = [
            'brand' => 'required|unique:brands,name,'.$this->id,
        ];

        if(str::length($this->brand) > 5) {
            $rules['email'] = 'required';
        }
        return $rules;
    }

    public function getRequestFiled()
    {
        return  [
            'name'=>$this->brand,
        ];
    }
}
