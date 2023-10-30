<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DeliveryPhoneResource;

class DeliveryResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            "Governorate"=>$this->Governorate,
            "city"=>$this->city,
            "email"=>$this->email,
            "password"=>$this->password,
            "national_ID"=>$this->national_ID,
            "available"=>$this->available,
            "phones" => $this->delivery_phone->map(function($phone) {
                return $phone->phone;
            })->toArray(),
        ];
    }
}
