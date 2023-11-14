<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addMedicationsByPharmacyModel extends Model
{
    use HasFactory;
    protected $table ="AddMedicationsByPharmacy";
    protected $fillable = [
        'category_id',
        'user_id',
        'price',
        'medicineName',
        'image'
    ];
}
