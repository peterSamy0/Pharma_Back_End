<?php

namespace App\Models;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyPhone extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'id',
        'phone',
        'pharmacy_id',
    ];

    function pharmacies(){
        return $this->belongsTo(Pharmacy::class);
    }
}
