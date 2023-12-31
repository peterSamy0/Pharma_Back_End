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
                        "user_id" => $client->user->id,
                        "client_name" => $client->user->name,
                        "client_email" => $client->user->email,
                        "client_password" => $client->user->password,
                        "image" => $this->user->image,
                        "client_phone" => $client->user->userPhone->map(function ($item) {
                            return [
                                'phone' => $item->phone
                            ];
                        })->toArray(),
                        "Governorate" => $client->governorate->governorate,
                        "city" => $client->city->city,
                        'orders' =>  OrderResource::collection($this->orders)
                    ];
                })
            ];
        }
        return [
            'data' => [
                "user_id" => $this->user->id,
                "client_name" => $this->user->name,
                "client_email" => $this->user->email,
                "client_password" => $this->user->password,
                "image" => $this->user->image,
                "client_phone" => $this->user->userPhone,
                "Governorate" => $this->governorate->governorate,
                "city" => $this->city->city,
                'orders' =>  OrderResource::collection($this->orders)
            ]
        ];
    }
}
