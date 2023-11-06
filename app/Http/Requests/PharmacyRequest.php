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
        $userId = $this->route('pharmacy')->user_id;
        return [
            'user.name' => 'required',
            'user.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'user.password' => 'required',
            'pharmacy.governorate_id' => 'required',
            'pharmacy.city_id' => 'required',
            'pharmacy.street' => 'required',
            'pharmacy.licence_number' => 'required',
            'pharmacy.opening' => 'required',
            'pharmacy.closing' => 'required',
            'pharmacy.bank_account' => 'required',
            'pharmacy.image' => 'required',
            'daysOff' => 'array', // daysOff must be an array
            'daysOff.*' => Rule::exists('days', 'id') // each value in daysOff must exist in the "days" table
        ];
    }

    public function messages()
    {
        return [
            'user.name.required' => 'The name field is required.',
            'user.email.required' => 'The email field is required.',
            'user.email.email' => 'The email must be a valid email address.',
            'user.email.unique' => 'The email has already been taken.',
            'user.password.required' => 'The password field is required.',
            'pharmacy.governorate_id.required' => 'The governorate ID field is required.',
            'pharmacy.city_id.required' => 'The city ID field is required.',
            'pharmacy.street.required' => 'The street field is required.',
            'pharmacy.licence_number.required' => 'The licence number field is required.',
            'pharmacy.opening.required' => 'The opening field is required.',
            'pharmacy.closing.required' => 'The closing field is required.',
            'pharmacy.bank_account.required' => 'The bank account field is required.',
            'pharmacy.image.required' => 'The image field is required.',
            'daysOff.array' => 'The days off must be an array.',
            'daysOff.*.exists' => 'One or more selected days off are invalid.',
        ];
    }
}
