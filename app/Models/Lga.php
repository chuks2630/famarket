<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function products(){
        return $this->hasMany(Product::class,'location_id');
    }

    public function equipments(){
        return $this->hasMany(Equipment::class,'location_id');
    }
}
