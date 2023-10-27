<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    // order has many order medications
    public function orderMedications(){
        return $this->hasMany(OrderMedication::class);
    }
    // order belongs to a client
    public function client(){
        return $this->belongsTo(Client::class);
    }
    // order belongs to a delivery
    // ......

    // filable fields
    protected $fillable = [
       
        'client_id' ,
        "pharmacy_id",
        "delivery_id",
        "status"
    ];
}
