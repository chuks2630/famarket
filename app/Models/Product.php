<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcat_id');
    }

    public function product_images(){
        return $this->hasMany(Product_image::class,'product_id');
    }


    public function lga(){
        return $this->belongsTo(Lga::class,'location_id');
    }

    
    public function bulk_sizes(){
        return $this->hasMany(Bulk_size::class);
    }

}
