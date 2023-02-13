<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rel_to_sub_cat(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    public function rel_to_cate(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
