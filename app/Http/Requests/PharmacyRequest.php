<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
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
            "name" => "required",
            "password" => "required",
            "email" => "unique:pharmacies",  
            "image" => "required",
            "licence_number" => "unique:pharmacies",
            "bank_account" => "unique:pharmacies",    
            "Governorate" => "required",
            "city" => "required",
            "street" => "required",  
            "opening" => "required",
            "closing" => "required",  
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "name is required",
            "password.required" => "password is required",
            "email.required" => "email is required",  
            "image.required" => "image is required",
            "licence_number.required" => "licence_number is required",
            "bank_account.required" => "bank_account is required",    
            "Governorate.required" => "covernorate is required",
            "city.required" => "city is required",
            "street.required" => "street is required",  
            "opening.required" => "opening is required",
            "closing.required" => "closing is required",  
        ];
    }
}
