<?php

namespace App\Models;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPhone extends Model
{
    use HasFactory;

    protected $table ="client_phones";
    protected $fillable = [
        'id',
        "phone",
        "client_id",
        
        ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
