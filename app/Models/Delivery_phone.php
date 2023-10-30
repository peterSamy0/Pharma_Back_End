<?php

namespace App\Models;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery_phone extends Model
{
    use HasFactory;
    protected $table= "delivery_phones";
    protected $fillable = ["phone", "delivery_id"];

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

}
