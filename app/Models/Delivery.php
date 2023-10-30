<?php

namespace App\Models;
use App\Models\Delivery_phone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table= "deliveries";
    protected $fillable=['name',"Governorate","city","email","password","national_ID","available"];

    public function delivery_phone(){
        return $this->hasMany(Delivery_Phone::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

}
