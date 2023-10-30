<?php

namespace App\Http\Resources;

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
        return [
            "id" => $this->id,
            "name" => $this->name,
            "password" => $this->password,
            "email" => $this->email, 
            "image" => $this->image,
            "licence_number" => $this->licence_number,
            "bank_account" => $this->bank_account,    
            "Governorate" => $this->Governorate,
            "city" => $this->city,
            "street" => $this->street, 
            "opening" => $this->opening,
            "closing" => $this->closing,  
            'phone' => $this->phone,
            'medication' => $this->medications,
            'days_off' => $this->days->id,
        ];
    }
}

