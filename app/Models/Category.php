<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function rel_to_user(){
        return $this->belongsTo(User::class,'addedBy');
    }

    public function rel_to_sub_cate(){
        return $this->hasMany(SubCategory::class,'category_id');
    }


}
