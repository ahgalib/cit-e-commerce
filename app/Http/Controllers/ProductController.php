<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;

class ProductController extends Controller
{
    public function store(){
        $data = Category::all();
        return view('admin.product.addProduct',compact('data'));

    }

    public function storeAjax(Request $request){
        $sub_cat = SubCategory::where('category_id',$request['catId'])->get();
        $sub_cats_info = '<option value="">Select Sub Category</option>';
        foreach($sub_cat as $sub_cats){
            $sub_cats_info.= "
            <option value='$sub_cats->id'>".$sub_cats->sub_category_name.'</option>';
        };
        echo $sub_cats_info;
    }
}
