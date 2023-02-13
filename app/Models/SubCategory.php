<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rel_to_user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function rel_to_category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
