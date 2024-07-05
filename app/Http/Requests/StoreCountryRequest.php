<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true//  TODO Role
            ;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2'],
            'country_code' => ['required', 'string', 'min:2'],
        ];
    }
}
