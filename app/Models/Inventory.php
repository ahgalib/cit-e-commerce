<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rel_to_product_color(){
        return $this->belongsTo(ProductColor::class,'product_color_id');
    }

    public function rel_to_product_size(){
        return $this->belongsTo(ProductSize::class,'product_size_id');
    }
}
