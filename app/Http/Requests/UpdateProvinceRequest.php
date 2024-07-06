<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProvinceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() === true// TODO ROLE PERMISSION
            ;
    }

    public function rules(): array
    {
        return [
            "name" => ['nullable', 'string', 'min:1'],
            "country_id" => ['nullable', 'integer', 'exists:countries,id'],
        ];
    }
}
