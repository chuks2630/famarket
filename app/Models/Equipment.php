<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcat_id');
    }

    public function lga(){
        return $this->belongsTo(Lga::class,'location_id');
    }


    public function equipment_images(){
        return $this->hasMany(Equipment_image::class);
    }
}
