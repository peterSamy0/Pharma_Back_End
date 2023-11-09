<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        "governorate" => $this->governorate,
        "id" => $this->id,
        "active" => false,
        "cities" => $this->cities->map(function ($city) {
            return [
                "city" => $city->city,
                "id" => $city->id,
                "pharmacies" => $city->pharmacies->map(function ($pharmacy) {
                    return [
                        'pharmacyName' => $pharmacy->user->name,
                        'address' => $pharmacy->street,
                        'image' => $pharmacy->image,
                        'id'=>$pharmacy->id
                    ]; // Replace 'name' with the actual property you want to access
                }),
            ];
        }),
    ];
}

}
