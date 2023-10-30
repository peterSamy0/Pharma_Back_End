<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:clients',
            'password' => 'required',
            'Governorate' => 'required',
            'city' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'Governorate.required' => 'Governorate is required',
            'city.required' => 'city is required',
            'email.required' => 'email is required',
            'password.required' => 'password is required',
        ];
    }
}
