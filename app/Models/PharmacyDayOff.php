<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;
use App\Models\Pharmacy;

class PharmacyDayOff extends Model
{
    use HasFactory;
    protected $table = "pharmacy_days_off";
    protected $fillable = [ 
        'id',
        'pharmacy_id',
        'day_id',
    ];

    function dayoff(){
        return $this->hasMany(Day::class);
    }

    function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}
