<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\Inventory;
use Auth;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return view('admin.product.product',compact('product'));
    }

    public function addProduct(){
        $data = Category::all();
        return view('admin.product.addProduct',compact('data'));

    }

    public function getSubCategoryAjax(Request $request){
        $sub_cat = SubCategory::where('category_id',$request['catId'])->get();
        $sub_cats_info = '<option value="">Select Sub Category</option>';
        foreach($sub_cat as $sub_cats){
            $sub_cats_info.= "
            <option value='$sub_cats->id'>".$sub_cats->sub_category_name.'</option>';
        };
        echo $sub_cats_info;

    }

    public function productStore(Request $request){
        $validate =  $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'long_desc' => 'required',
            'preview' => 'required|mimes:jpg,png,jpeg|max:1000',
        ]);

        if($request->discount){
            $after_discount = $request->product_price - ($request->product_price * $request->discount/100 );

        }else{
            $after_discount = $request->product_price;
        }

        $upload_file = $request['preview'];
        $extension = $upload_file->getClientOriginalExtension();
        $file_name = rand(000000,999999).'.'.$extension;
        //echo $file_name;die;
        Image::make($upload_file)->resize(550,400)->save(public_path('/upload/products/'.$file_name));

        $product_id = Product::insertGetId([
            'category_id' => $request['category_id'],
            'sub_category_id' => $request['sub_category_id'],
            'product_name' => $request['product_name'],
            'product_price' => $request['product_price'],
            'discount' => $request['discount'],
            'after_discount' => $after_discount,
            'brand' => $request['brand'],
            'short_desc' => $request['short_desc'],
            'long_desc' => $request['long_desc'],
            'preview' => $file_name,
            'slug' => str_replace(' ','-',$request['product_name']).'-'.rand(0000,9999),
            'created_at' => Carbon::now()

        ]);

        //product Thumbnail
        $upload_thumbnails = $request->thumbnail;

        foreach($upload_thumbnails as $thumbnail){
            $extension = $thumbnail->getClientOriginalExtension();
            // echo $extension;die;
            $thumbnail_name = rand(000000,999999).'.'.$extension;
            // echo $thumbnail_name;
            Image::make($thumbnail)->resize(550,400)->save(public_path('/upload/thumbnails/'.$thumbnail_name));

            ProductThumbnail::create([
                'product_id' => $product_id,
                'thumbnail' => $thumbnail_name
            ]);
        }
        return back();
    }

    public function productVeriant(){
        $colors = ProductColor::all();
        $sizes = ProductSize::all();
        return view('admin.product.veriant',compact('colors','sizes'));
    }

    public function productColorStore(Request $request){
        ProductColor::create([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code
        ]);
        return back();
    }

    public function productSizeStore(Request $request){
        ProductSize::create([
            'size_name' => $request->size_name,

        ]);
        return back();
    }

    public function edit($slug){
        $data = Category::all();
        $product = Product::where('slug',$slug)->first();
        //echo"<pre>";print_r($product);die;
        return view('admin.product.editProduct',compact('product','data'));
    }

    // public function update(Request $request,$id){

    //     mage update
    //     if($request->preview){

    //         delete old image
    //         $find_image = Product::find($id);
    //         $image = $find_image['image'];


    //         $image = $find_image['image'];
    //         echo $image;
    //         die;
    //         $image_path = public_path('/upload/products/'.$image);
    //         unlink($image_path);

    //         insert new image
    //         $image = $request['image'];
    //         $image_extension = $image->getClientOriginalExtension();
    //         $image_new_name = rand(000000,999999).'.'.$image_extension;
    //         $main_image = Image::make($image)->save(public_path('/upload/products/'.$image_new_name));

    //         update with image
    //         Product::where('id',$id)->update([
    //             'category_id' => $request['category_id'],
    //             'product_name' => $request['product_name'],
    //             'title' => $request['title'],
    //             'price' => $request['price'],
    //             'discount' => $request['discount'],
    //             'brand' => $request['brand'],
    //             'description' => $request['description'],
    //             'image' => $image_new_name,
    //             'stock' => $request['stock'],
    //             'slug' => str_replace(' ','-',$request['product_name']).'-'.rand(000000,999999),
    //         ]);

    //     }else{
    //         echo "image nai";
    //         update without image
    //         Product::where('id',$id)->update([
    //             'category_id' => $request['category_id'],
    //             'product_name' => $request['product_name'],
    //             'title' => $request['title'],
    //             'price' => $request['price'],
    //             'discount' => $request['discount'],
    //             'brand' => $request['brand'],
    //             'description' => $request['description'],
    //             'stock' => $request['stock'],
    //             'slug' => str_replace(' ','-',$request['product_name']).'-'.rand(000000,999999),
    //         ]);
    //     }


    // }

    public function addInventory($id){
        $product = Product::find($id);
        $colors = ProductColor::all();
        $sizes = ProductSize::all();
        $inventories = Inventory::where('product_id',$id)->get();
        return view('admin.product.addInventory',compact('product','colors','sizes','inventories'));
    }

    public function inventoryStore(Request $request){
        $validate = $request->validate([
            'product_color_id' => 'required',
            'product_size_id' => 'required',
            'quantity' => 'required'
        ]);

        if(Inventory::where('product_id',$request->product_id)->where('product_color_id',$request->product_color_id)->where('product_size_id',$request->product_size_id)->exists()){

            Inventory::where('product_id',$request->product_id)->where('product_color_id',$request->product_color_id)->where('product_size_id',$request->product_size_id)->increment('quantity',$request->quantity);

        }else{
            Inventory::create([
                'product_id' => $request['product_id'],
                'product_color_id' => $request['product_color_id'],
                'product_size_id' => $request['product_size_id'],
                'quantity' => $request['quantity'],
            ]);
        }

        return back();
    }

    public function deleteProduct($id){
        $image = Product::where('id',$id)->get()->first();
        //echo $image['preview'];die;
        if($image['preview']){
            $image_name =  $image['preview'];
            $image_path = public_path('/upload/products/'.$image_name);
            unlink($image_path);
        }

        $product_thumb = ProductThumbnail::where('product_id',$id)->get();
        foreach($product_thumb as $thumb){
            $image_name2 =  $thumb['thumbnail'];
            $image_path2 = public_path('/upload/thumbnails/'.$image_name2);
            unlink($image_path2);

            ProductThumbnail::where('product_id',$thumb->id)->delete();
        }

        $product_invnt = Inventory::where('product_id',$id)->get();
        //echo $product_invnt;die;
        foreach($product_invnt as $inventory){
            Inventory::where('product_id',$inventory->id)->delete();
        }

        Product::find($id)->delete();
        return back();

    }

}
