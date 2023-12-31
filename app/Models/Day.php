<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PharmacyDayOff;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'day',
    ];

    function daysOff(){
        return $this->belongsTo(PharmacyDayOff::class);
    }


}

