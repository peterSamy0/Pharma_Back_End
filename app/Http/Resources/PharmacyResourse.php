<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        if($this instanceof Collection){
            $this->map(function ($pharmacy){
                return[
                    "pharmacy_id" => $pharmacy->user->id,
                    "pharmacy_name" => $pharmacy->user->name,
                    "pharmacy_email" => $pharmacy->user->email,
                    "image" => $pharmacy->image,
                    "licence_number" => $pharmacy->licence_number,
                    "bank_account" => $pharmacy->bank_account,    
                    "Governorate" => $pharmacy->governorate->governorate,
                    "governorate_id" => $pharmacy->governorate->id,
                    "city" => $pharmacy->city->city,
                    "city_id" => $pharmacy->city->id,
                    "street" => $pharmacy->street, 
                    "opening" => $pharmacy->opening,
                    "closing" => $pharmacy->closing,  
                    "daysOff" => $pharmacy->daysOff->map(function ($day) {
                        return [
                            "day_id" => $day->day_id,
                            "day_name" => $day->day->day
                        ];
                    }),    
                    // 'phone' => $this->phone,
                    'medication' => $pharmacy->pharmacyMedications->map(function ($medicine){
                        return[
                            'id' => $medicine->medication->id,
                            'medicine_name' => $medicine->medication->name,
                            'medicine_price' => $medicine->medication->price,
                            'medicine_image' => $medicine->medication->image,
                            'medicine_category' => $medicine->medication->category->name,
                        ];
                    }),
                ];
            });
        }
        return [
            "pharmacy_id" => $this->user->id,
            "pharmacy_name" => $this->user->name,
            "password" => $this->user->password,
            "pharmacy_email" => $this->user->email,
            "image" => $this->image,
            "licence_number" => $this->licence_number,
            "bank_account" => $this->bank_account,    
            "Governorate" => $this->governorate->governorate,
            "governorate_id" => $this->governorate->id,
            "city" => $this->city->city,
            "city_id" => $this->city->id,
            "street" => $this->street, 
            "opening" => $this->opening,
            "closing" => $this->closing,  
            "daysOff" => $this->daysOff->map(function ($day) {
                return [
                    "day_id" => $day->day_id,
                    "day_name" => $day->day->day
                ];
            }),  
            // 'phone' => $this->phone,
            'medication' => $this->pharmacyMedications->map(function ($medicine){
                return[
                    'id' => $medicine->medication->id,
                    'medicine_name' => $medicine->medication->name,
                    'medicine_price' => $medicine->medication->price,
                    'medicine_image' => $medicine->medication->image,
                    'medicine_category' => $medicine->medication->category->name,
                ];
            }),
        ];
    }
}

