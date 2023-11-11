<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicationRequest extends FormRequest
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
            "name" => "required | unique:medications",
            "price" => "required | integer",
            "image" => "required | unique:medications", 
            'category' => 'required',
            
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'the name is required',
        'price.required' => ' the price is required',
        'image.required' => ' the image is required',
        'category' => ' the category is required',
    ];
}
}
