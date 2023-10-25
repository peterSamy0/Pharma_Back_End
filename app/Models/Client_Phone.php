<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client_Phone extends Model
{
    use HasFactory;

    protected $fillable = ["client_id", "phone"];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
