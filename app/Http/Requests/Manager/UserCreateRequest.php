<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // TODO ROLE
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required' , 'string' , "max:250" , "min:3"],
            "email" => ['required' , 'email' , "max:250" , "min:3"],
            "password" => ['required' , 'string' , "max:250" , "min:3"],
        ];
    }
}
