<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
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
        if($this instanceof Collection){
            $this->map(function ($delivery){
                return [
                    'id'=>$delivery->id,
                    'name'=>$delivery->user->name,
                    "email"=>$delivery->user->email,
                    "national_ID"=>$delivery->national_ID,
                    "Governorate"=>$delivery->governorate->governorate,
                    "city"=>$delivery->city->city,
                    "available"=>$delivery->available,
                    "orders" => $delivery->orders
                ];
            });
        }
        return [
            'id'=>$this->id,
            'name'=>$this->user->name,
            "email"=>$this->user->email,
            "national_ID"=>$this->national_ID,
            "Governorate"=>$this->governorate->governorate,
            "city"=>$this->city->city,
            "available"=>$this->available,
            "orders" => $this->orders->map(function ($order){
                return [
                    "order id" => $order->id,
                    "client name" => $order->client->user->name,
                    "pharmacy name" => $order->pharmacy->user->name,
                    "created at" => $order->created_at,
                ];
            })
            // "phones" => $this->delivery_phone->map(function($phone) {
            //     return $phone->phone;
            // })->toArray(),
        ];
    }
}
