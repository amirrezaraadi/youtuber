<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvinceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check() === true
            // TODO ROLE PERMISSION
            ;
    }

    public function rules(): array
    {
        return [
            "name" => ['required' , 'string' , 'min:1'],
            "country_id" => ['required' , 'integer' , 'exists:countries,id'],
        ];
    }
}
