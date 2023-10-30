<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //temporary
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
            'name'=>'required',
            'Governorate'=>'required',
            'city'=>'required',
            'email'=>'unique:deliveries',
            'password'=>'required',
            'national_ID'=>'unique:deliveries|integer',
            'available'=>'required|integer|in:1,0'

        ];
    }

}
