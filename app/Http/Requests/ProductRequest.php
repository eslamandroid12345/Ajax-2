<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [


            'image' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',


        ];
    }
}
