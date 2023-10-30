<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryController extends FormRequest
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
            //
            'name'=>"required",
            "Governorate"=>"required",
            "city"=>"required",
            'email' => [
                'required',
                Rule::unique('deliveries')->ignore($this->delivery->email, 'email'),
            ],
            "password"=>"required",
            "national_ID" => [
                'required',
                Rule::unique('deliveries')->ignore($this->delivery->national_ID, 'national_ID'),
                'integer',
                'min:14',
            ],
            "available"=>"required|integer|in:1,0"
        ];
    }
}
