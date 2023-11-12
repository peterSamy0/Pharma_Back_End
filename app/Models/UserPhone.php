<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserPhone extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}
