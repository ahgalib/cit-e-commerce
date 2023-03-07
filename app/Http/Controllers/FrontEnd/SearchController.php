<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\ProductSize;

class SearchController extends Controller
{
    public function search(Request $request){
        $data = $request->all();
        $category = Category::all();
        $color = ProductColor::all();
        $size = ProductSize::all();

        $search_products = Product::where(function($q) use ($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('product_name','like','%'.$data['q'].'%');
                    $q->orWhere('long_desc','like','%'.$data['q'].'%');

                });
            }

            //if anyone donot choose a min value
            $min = 0;
            if(!empty($data['min']) && $data['min'] != '' && $data['max'] != 'undefined'){
                $min = $data['min'];
            }else{
                $min = 1;
            }

            //if anyone donot choose a max value
            $max = 0;
            if(!empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined'){
                $max = $data['max'];
            }else{
                $max = 1000000000;
            }

            if(!empty($data['min']) && $data['min'] != '' && $data['max'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined'){
                $q->whereBetween('after_discount',[$min,$max]);
            }


            //if anyone donot choose a category
            // $category = '';
            // if(!empty($data['cat']) && $data['cat'] != '' && $data['cat'] != 'undefined'){
            //     $category = $data['cat'];
            // }else{
            //     $category = '';
            // }

            if(!empty($data['cat']) && $data['cat'] != '' && $data['cat'] != 'undefined'){
                $q->where('category_id',$data['cat']);
            }
        })->get();


        return view('front_end.search',compact('search_products','category','color','size'));
    }
}
