<?php

namespace App\Http\Resources;

use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MedicationResource;
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'pharmacy_id' => $this->pharmacy_id,
            'delivery_id' => $this->delivery_id,
            'status' => $this->status,
            
            'orderMedications' => $this->orderMedications->map(function ($orderMedication) {
                return [
                    'order_id' => $orderMedication->order_id,
                    'medicine_id' => $orderMedication->medicine_id,
                    'amount' => $orderMedication->amount,
                    "name"=>$orderMedication->medication
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