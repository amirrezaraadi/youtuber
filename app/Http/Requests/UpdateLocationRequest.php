<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latitude' => ['nullable', 'string', 'min:1', "max:250"],
            'longitude' => ['nullable', 'string', 'min:1', "max:250"],
            'building_number' => ['nullable', 'string', 'min:1', "max:250"],
            'unit' => ['nullable', 'integer'],
            "mobile" => ['nullable', 'string', 'min:1', "max:250"],
            "telephone" => ['nullable', 'string', 'min:1', "max:250"],
            "postal_code" => ['nullable', 'integer'],
            "address" => ['nullable', 'string', 'min:1', "max:4000"],
            'province_id' => ['nullable', 'integer' , "exists:provinces,id"],
            'city_id' => ['nullable', 'integer' , "exists:cities,id"],
        ];
    }
}
