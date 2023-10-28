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
            "name" => "unique:medications",
            "price" => "required",
            "image" => "required", 
            'category_id' => 'required',
            
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'A name is required',
        'price.required' => 'price is required',
        'image.required' => 'image is required',
        'category_id' => 'category is required',
    ];
}
}
