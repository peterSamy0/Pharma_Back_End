<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "name" ,
        "Governorate",
        "city",
        "email",
        "password",
    ];


    public function phone(){
        return $this->hasMany(Client_Phone::class);
    }
}
