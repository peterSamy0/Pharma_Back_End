<?php

namespace App\Models;
use App\Models\ClientPhone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "Governorate",
        "city",
    ];


    public function phone(){
        return $this->hasMany(ClientPhone::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    } 
    public function city(){
        return $this->belongsTo(City::class);
    }   
    public function governorate(){
        return $this->belongsTo(Governorate::class);
    } 
}

