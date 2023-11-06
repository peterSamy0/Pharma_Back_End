<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateResource extends JsonResource
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
                    "cities" => $govern->cities->map(function ($city){
                        return [
                            "city_id"=> $city->id,
                            "city_name"=> $city->city,
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
