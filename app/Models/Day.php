<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PharmacyDaysOff;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'days',
    ];

    function days(){
        return $this->hasMany(PharmacyDaysOff::class);
    }
}

