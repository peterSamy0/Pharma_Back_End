<?php

namespace App\Http\Resources;

use App\Models\Medication;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MedicationResource;
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
                            'client name' => $order->client->user->name,
                            'pharmacy name' => $order->pharmacy->user->name,
                            'delivery name' => $order->delivery->user->name,
                            'status' => $order->status,
                            'created at' => $order->created_at,
                            'updated at' => $order->updated_at,
                            'orderMedications' => $order->orderMedications->map(function ($ordMedication){
                                return [
                                    // "order id"=>  $ordMedication->order_id,
                                    // "medicine name" => $ordMedication->medication,
                                    "medicine id" => $ordMedication->medicine_id,
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
            'client name' => $this->client->user->name,
            'pharmacy name' => $this->pharmacy->user->name,
            'delivery name' => $this->delivery->user->name,
            'status' => $this->status,
            'created at' => $this->created_at,
            'updated at' => $this->updated_at,
            'orderMedications' => $this->orderMedications->map(function ($ordMedication){
                return [
                    // "order id"=>  $ordMedication->order_id,
                    // "medicine name" => $ordMedication->medication,
                    "medicine id" => $ordMedication->medicine_id,
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