<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
    // $userId = $this->route('pharmacy')->user_id;
    // $pharmacyId = $this->route('pharmacy')->id;

    return [
        'user.name' => 'required',
        'user.email' => 'required|email|unique:users,email',
        'user.password' => 'required',
        'pharmacy.licence_number' => 'required|unique:pharmacies,licence_number',
        'pharmacy.bank_account' => 'required|unique:pharmacies,bank_account',
        'pharmacy.governorate_id' => 'required',
        'pharmacy.city_id' => 'required',
        'pharmacy.street' => 'required',
        'pharmacy.opening' => 'required',
        'pharmacy.closing' => 'required',
        'pharmacy.image' => 'required',
        'daysOff' => 'array',
        'daysOff.*' => Rule::exists('days', 'id'),
    ];
}

    public function messages()
    {
        return [
            //
        ];
    }
}
