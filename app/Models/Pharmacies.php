<?php

namespace App\Models;
use App\Models\PharmacyMedications;
use App\Models\PharmacyPhone;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacies extends Model
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
        return $this->hasMany(PharmacyMedications::class);
    }

    function phone(){
        return $this->hasMany(PharmacyPhone::class);
    }
}
