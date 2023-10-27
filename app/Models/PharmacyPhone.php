<?php

namespace App\Models;
use App\Models\Pharmacies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyPhone extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'id',
        'pharmacy_id',
        'medication_id',
    ];

    function pharmacies(){
        return $this->belongsTo(Pharmacies::class);
    }
}
