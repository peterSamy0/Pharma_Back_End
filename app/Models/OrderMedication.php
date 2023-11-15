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
    
    // belongs to order
    public function order(){
        return $this->belongsTo(Order::class);
    }

    // belongs to medications
    public function medicine(){
        return $this->belongsTo(Medication::class);
    }
 
}
