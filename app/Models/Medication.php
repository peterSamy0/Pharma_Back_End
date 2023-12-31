<?php

namespace App\Models;

use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',
        'name',
        'description',
        'price',
        'image',
        'category_id',
    ];

    function category(){
        return $this->belongsTo(Category::class);
    }
    public function orderMedications(){
        return $this->hasMany(OrderMedication::class);
    }

    function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}
