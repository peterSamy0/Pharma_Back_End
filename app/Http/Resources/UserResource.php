<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'Governorate' => $this->pharmacy[0]->Governorate,
            'city' => $this->pharmacy[0]->city,
            'street' => $this->pharmacy[0]->street,
            'licence_number' => $this->pharmacy[0]->licence_number,
            'bank_account' => $this->pharmacy[0]->bank_account,
            'opening' => $this->pharmacy[0]->opening,
            'closing' => $this->pharmacy[0]->closing
        ];
    }
}


	
	
	
	
