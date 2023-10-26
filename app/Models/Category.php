<?php

namespace App\Models;
use App\Models\Medication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    function medications(){
        return $this->hasMany(Medication::class);
    }
}
