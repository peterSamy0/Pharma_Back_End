<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
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
        if($this instanceof Collection){
            $this->map(function ($govern){
                return [
                    "governorate_id" => $govern->id,
                    "governorate_name" => $govern->governorate,
                    "cities" => $govern->cities->map(function ($medication){
                        return [
                            'id' => $this->id,
                            'name' =>$this->name,
                            'price'=>$this->price,
                            'image'=>$this->image,
                            'category_id'=>$this->category_id,   
                            'category' =>$this->category->name,
                        ];
                    })
                ];
            });
        }
        return [
            "governorate_id" => $this->id,
            "governorate_name" => $this->governorate,
            "cities" => $this->cities->map(function ($city){
                return [
                    "city_id"=> $city->id,
                    "city_name"=> $city->city,
                ];
            })
        ];
    }
}
