<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'name' =>$this->name,
            'price'=>$this->price,
            'image'=>$this->image,
            'category_id'=>$this->category_id,
            'category_id'=>$this->category->name,   
            'category' =>$this->category->name,
        ];
    }
}
