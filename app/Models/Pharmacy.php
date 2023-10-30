<?php

namespace App\Models;
use App\Models\PharmacyMedication;
use App\Models\PharmacyPhone;
use App\Models\PharmacyDayOff;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',
        'name',
        'password',
        'email',
        'image',
        'licence_number',
        'bank_account',
        'Governorate',
        'city',
        'street',
        'opening',
        'closing',
    ];

    function medications(){
        return $this->hasMany(PharmacyMedication::class);
    }

    function phone(){
        return $this->hasMany(PharmacyPhone::class);
    }

    function days (){
        return $this->hasMany(PharmacyDayOff::class);
    }
}
