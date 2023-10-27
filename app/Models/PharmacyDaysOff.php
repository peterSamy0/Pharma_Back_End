<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;

class PharmacyDaysOff extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'id',
        'pharmacy_id',
        'day_id',
    ];

    function dayoff(){
        return $this->hasMany(Day::class);
    }
}
