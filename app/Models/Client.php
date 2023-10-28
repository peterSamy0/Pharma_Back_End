<?php

namespace App\Models;
use App\Models\ClientPhone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
       'id',
        "name" ,
        "Governorate",
        "city",
        "email",
        "password"
    ];


    public function phone(){
        return $this->hasMany(ClientPhone::class); 
    }
}

