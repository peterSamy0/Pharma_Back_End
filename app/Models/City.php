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
    public function clients(){
        return $this->hasMany(Client::class);
    }
    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }
}
