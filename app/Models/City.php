<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'city',
        'governorate_id'
    ];
    // city has many clients
    public function client(){
        return $this->hasMany(Client::class);
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }
    public function pharmacies(){
        return $this->hasMany(Pharmacy::class);
    }
    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }
    
}
