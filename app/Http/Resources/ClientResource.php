<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
        
 
class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        
        if ($this instanceof EloquentCollection || $this instanceof Collection) {
            return [
                'data' => $this->map(function ($client) {
                    return [
                        'name' => optional($client->user)->name,
                        'Governorate' => $client->governorate->governorate,
                        'city' => $client->city->city,
                        'email' => optional($client->user)->email,
                        'order' =>  OrderResource::collection($this->orders)
                    ];
                })
            ];
        }
        return [
            'data' => [
                'name' => optional($this->user)->name,
                'Governorate' => $this->governorate->governorate,
                'city' => $this->city->city,
                'email' => optional($this->user)->email,
                'order' =>  OrderResource::collection($this->orders)
            ]
        ];
    }
}
