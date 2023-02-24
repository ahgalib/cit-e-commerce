<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Inventory;
use App\Models\Category;


class FrontProductController extends Controller
{
    public function index(){
        $products = Product::latest()->limit(5)->get();
        return view('front_end.index',compact('products'));
    }

    public function productDetails($slug){
        $product = Product::where('slug',$slug)->get()->first();
        $product_id = $product->id;
        $product_thumbnails = ProductThumbnail::where('product_id',$product_id)->get();
        $product_inventory = Inventory::where('product_id',$product_id)->get();
        $related_product = Product::where('category_id',$product->category_id)->where('id','!=',$product_id)->get();
        $category = Product::where('category_id',$product->category_id)->first();
        $sub_cat = Product::where('category_id',$product->category_id)->get();
        $product_color = Inventory::where('product_id',$product_id)->groupBy('product_color_id')->selectRaw('count(*) as total,product_color_id')->get();
        $product_size =  Inventory::where('product_id',$product_id)->get();

        return view('front_end.details',compact('product','product_thumbnails','product_inventory','category','related_product','sub_cat','product_color','product_size'));
    }


    public function ajaxProductVeriant(Request $request){
        $info = Inventory::where('product_id',$request->productId)->where('product_color_id',$request->colorId)->get();
        //echo $info->product_size_id;
        $option = '<option value="">Available Size for this color</option>';
        foreach($info as $size){
            //echo $size->product_size_id;
            $option.= "<option value='{$size->rel_to_product_size->id}'>".$size->rel_to_product_size->size_name.'</option>';

        }
        echo $option;
    }




}
