<?php

namespace App\Http\Resources;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyMedicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pharmacy = Pharmacy::where('id', $this->pharmacy_id)->first();
        return [
            "pharmacyMedicationID" => $this->id,
            "id" => $this->medication->id,
            "name" => $this->medication->name,
            "pharmacyID" => $pharmacy->id,
            "category" => $this->medication->category->name,
            "price" => $this->price ? $this->price : $this->medication->price,
        ];
    }
}
