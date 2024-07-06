<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latitude' => ['required', 'string', 'min:1', "max:250"],
            'longitude' => ['required', 'string', 'min:1', "max:250"],
            'building_number' => ['required', 'string', 'min:1', "max:250"],
            'unit' => ['required', 'integer'],
            "mobile" => ['required', 'string', 'min:1', "max:250"],
            "telephone" => ['required', 'string', 'min:1', "max:250"],
            "postal_code" => ['required', 'integer'],
            "address" => ['required', 'string', 'min:1', "max:4000"],
            'province_id' => ['required', 'integer' , "exists:provinces,id"],
            'city_id' => ['required', 'integer' , "exists:cities,id"],
        ];
    }
}
