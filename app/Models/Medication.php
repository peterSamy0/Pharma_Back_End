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
        'price',
        'image',
        'category_id',
    ];

    function category(){
        return $this->belongsTo(Category::class);
    }
}
