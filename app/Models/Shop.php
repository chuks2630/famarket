<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'shopname',
        'description'
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop_adds(){
        return $this->hasMany(Shop_add::class);
    }

}
