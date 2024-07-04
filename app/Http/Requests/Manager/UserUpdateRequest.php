<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:3', "mix:250"],
            'password' => ['nullable', 'string', 'min:3', "mix:250"],
            'full_name' => ['nullable', 'string', 'min:3', "mix:250"],
            'profile' => ['nullable', 'image', "mimes:jpeg,png,jpg,gif", "size:1024"],
            'website' => ['nullable', 'string', 'url:http,https', 'min:3', "mix:250"],
            'body' => ['nullable', 'string', 'min:3', "mix:250"],
        ];
    }
}
