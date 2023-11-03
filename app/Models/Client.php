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
}

