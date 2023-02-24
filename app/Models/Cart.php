<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rel_to_product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function rel_to_color(){
        return $this->belongsTo(ProductColor::class,'color_id');
    }

    public function rel_to_size(){
        return $this->belongsTo(ProductSize::class,'size_id');
    }

}
