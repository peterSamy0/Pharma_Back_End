<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryMedicationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->medication_id);
        return [
            "medicine_name" => $this->medication->name,
            "medicine_image" => $this->medication->image,
            "medicine_price" => $this->medication->price,
            "id" => $this->medication_id,
            "category_id"=>$this->medication->category_id,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}
