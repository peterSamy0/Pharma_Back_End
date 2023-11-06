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
                    "pharmacy name" => $pharmacy->user->name,
                    "image" => $pharmacy->image,
                    "licence_number" => $pharmacy->licence_number,
                    "bank_account" => $pharmacy->bank_account,    
                    "Governorate" => $pharmacy->governorate->governorate,
                    "city" => $pharmacy->city->city,
                    "street" => $pharmacy->street, 
                    "opening" => $pharmacy->opening,
                    "closing" => $pharmacy->closing,  
                    // 'phone' => $this->phone,
                    'medication' => $this->medications,
                ];
            });
        }
        return [
            "pharmacy name" => $this->user->name,
            "image" => $this->image,
            "licence_number" => $this->licence_number,
            "bank_account" => $this->bank_account,    
            "Governorate" => $this->governorate->governorate,
            "city" => $this->city->city,
            "street" => $this->street, 
            "opening" => $this->opening,
            "closing" => $this->closing,  
            // 'phone' => $this->phone,
            'medication' => $this->pharmacyMedications->map(function ($medicine){
                return[
                    'medicine name' => $medicine->medication->name,
                    'medicine price' => $medicine->medication->price,
                    'medicine image' => $medicine->medication->image,
                    'medicine category' => $medicine->medication->category->name,
                ];
            }),
        ];
    }
}

