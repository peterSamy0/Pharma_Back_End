<?php

namespace App\Http\Resources;

use App\Models\Medication;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MedicationResource;
use App\Models\OrderMedication;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class OrderResource extends JsonResource
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
                'data' => $this->map(function ($order) {
                    return [
                            'id' => $order->id,
                            'client_name' => $order->client->user->name,
                            'pharmacy_name' => $order->pharmacy->user->name,
                            'delivery_name' => $order->delivery->user->name,
                            'status' => $order->status,
                            'pharmacy_id'=>$this->pharmacy->id,
                            'created_at' => $order->created_at,
                            'updated_at' => $order->updated_at,
                            'orderMedications' => $order->orderMedications->map(function ($ordMedication){
                                return [
                                    // "order id"=>  $ordMedication->order_id,
                                    "medicine_name" => $ordMedication->medication->name,
                                    "price" => $ordMedication->medicine->price,
                                    "medicine_id" => $ordMedication->medicine_id,
                                    "amount"=>  $ordMedication->amount,
                                    "created_at"=> $ordMedication->created_at,
                                    "updated_at"=> $ordMedication->updated_at,
                                ];
                            })
                        ];
                })
            ];
        }
        return [
            'id' => $this->id,
            'client_name' => $this->client->user->name,
            'pharmacy_address' => $this->pharmacy->governorate->governorate . ", ".$this->pharmacy->city->city . ", ".$this->pharmacy->street,
            'pharmacy_name' => $this->pharmacy->user->name,
            'delivery_name' => $this->delivery ? $this->delivery->user->name : "no delivery yet",
            'status' => $this->status,
            'pharmacy_id'=>$this->pharmacy->id,
            'payment'=> +$this->payment,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'orderMedications' => $this->orderMedications->map(function ($ordMedication){
                return [
                    // "order id"=>  $ordMedication->order_id,
                    // dd($ordMedication->medication),
                    "medicine_name" => $ordMedication->medicine->name,
                    "medicine_image" => $ordMedication->medicine->image,
                    "price" => $ordMedication->medicine->price,
                    "medicine_id" => $ordMedication->medicine_id,
                    "amount"=>  $ordMedication->amount,
                    "created_at"=> $ordMedication->created_at,
                    "updated_at"=> $ordMedication->updated_at,
                ];
            })
        ];
    }

}






// public function toArray($request)
// {
//     return [
//         'id' => $this->id,
//         'other_order_medication_attributes' => $this->other_order_medication_attributes,
//         'medications' => MedicationResource::collection($this->medications),
//         // Add more attributes as needed
//     ];
// }
