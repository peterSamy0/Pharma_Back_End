<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderMedication extends Model
{
    use HasFactory;
    use SoftDeletes;
    //filaable fields:
    protected $fillable = [
       
        'order_id' ,
        "medicine_id",
        "amount"
    ];
    protected $dates = ['deleted_at'];
    // belongs to order
    public function order(){
        return $this->belongsTo(Order::class);
    }
    // belongs to medications
    public function medication(){
        return $this->belongsTo(Medication::class);
    }


    
 
    
}

// //in OrderMedicationResource.php
// public function toArray($request)
// {
//     return [
//         'id' => $this->id,
//         'medication' => new MedicationResource($this->medication), // Assuming you have a "medication" relationship in the "OrderMedication" model.
//         // Add other attributes you want to include in the orderMedication resource
//     ];
// }