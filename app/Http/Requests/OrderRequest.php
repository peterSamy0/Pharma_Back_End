<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'delivery_id' => 'nullable|exists:deliveries,id',
            'ordMedications' => 'required|array',
            'ordMedications.*.key' => 'required|numeric|exists:order_medications,id',
            'ordMedications.*.value' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'pharmacy_id.required' => 'The pharmacy field is required.',
            'pharmacy_id.exists' => 'The selected pharmacy is invalid.',
            'delivery_id.exists' => 'The selected delivery is invalid.',
            'ordMedications.required' => 'The ordMedications field is required.',
            'ordMedications.array' => 'The ordMedications must be an array.',
            'ordMedications.*.key.required' => 'The key field for ordMedication is required.',
            'ordMedications.*.key.numeric' => 'The key field for ordMedication must be a number.',
            'ordMedications.*.key.exists' => 'The selected key for ordMedication is invalid.',
            'ordMedications.*.value.required' => 'The value field for ordMedication is required.',
            'ordMedications.*.value.numeric' => 'The value field for ordMedication must be a number.',
        ];
    }
}
