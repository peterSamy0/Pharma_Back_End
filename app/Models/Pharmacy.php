<?php

namespace App\Models;
use App\Models\User;
use App\Models\Order;
use App\Models\PharmacyDayOff;
use App\Models\PharmacyMedication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'licence_number',
        'bank_account',
        'governorate_id',
        'city_id',
        'street',
        'opening',
        'closing',
        'user_id',
        'admin_approval'
    ];

    function pharmacyMedications(){
        return $this->hasMany(PharmacyMedication::class);
    }

    function daysOff (){
        return $this->hasMany(PharmacyDayOff::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    
    public function userPhone(){
        return $this->hasMany(UserPhone::class);
    }

}
