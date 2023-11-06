<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;
    protected $fillable = ['governorate'];
    public function cities(){
        return $this->hasMany(City::class);
    }
    public function client(){
        return $this->belongsTo(City::class);
    } 

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }
}
