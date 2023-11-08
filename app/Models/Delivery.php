<?php

namespace App\Models;
use App\Models\Delivery_phone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table= "deliveries";
    protected $fillable=[
        'name',
        "email",
        "password",
        "governorate_id",
        "city_id",
        "national_ID",
        "available", 
        "user_id"
    ];

    public function delivery_phone(){
        return $this->hasMany(Delivery_Phone::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
}
