<?php

namespace App\Models;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyMedication extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',
        'pharmacy_id',
        'medication_id',
        'price'
    ];

    function pharmacies(){
        return $this->hasMany(Pharmacy::class);
    }
    function medication(){
        return $this->belongsTo(Medication::class);
    }
}
