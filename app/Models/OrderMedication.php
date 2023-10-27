<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMedication extends Model
{
    use HasFactory;

    // belongs to order
    public function order(){
        return $this->belongsTo(Order::class);
    }
    // belongs to medications
    public function medication(){
        return $this->belongsTo(Medication::class);
    }

    //filaable fields:
    protected $fillable = [
       
        'order_id' ,
        "medicine_id",
        "amount"
    ];
 
    
}
