<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;

class SubCategoryController extends Controller
{
    public function index(){
        $data = Category::all();
        $sub_cat = SubCategory::all();
        return view('admin.categories.subCategories',compact('data','sub_cat'));
    }

    public function create(Request $request){
        $data = $request->validate([
            'sub_category_name' => 'required',
        ]);

        SubCategory::create([
            'category_id' => $request['category_id'],
            'sub_category_name' => $data['sub_category_name'],
            'user_id' => Auth::id(),
        ]);

        return back();
    }

    public function ajaxSubCategory(Request $request){
        $data = $request->all();
        $catId = SubCategory::where('category_id',$data['catVal'])->get();
         //$catIds = json_decode(json_encode($getCategory),true);
        echo "<pre>";print_r($catId);
        return view('admin.categories.subCategories',compact('catIds'));
    }
}
