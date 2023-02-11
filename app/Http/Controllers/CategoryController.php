<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use Auth;
class CategoryController extends Controller
{
    public function index(){
        $data = Category::all();
        $trash = Category::onlyTrashed()->get();
        return view('admin.categories.category',compact('data','trash'));
    }

    public function trash(){
        $trash = Category::onlyTrashed()->get();
        return view('admin.categories.trash',compact('trash'));
    }

    public function create(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:1000'
        ],[
            //add custome validate message
            'image.max' => 'The image must not be greater than 1mb'
        ]);

        //check if image is select or not
        if($request->image){
            $upload_file = $request['image'];
            $extension = $upload_file->getClientOriginalExtension();
            $file_name = rand(000000,999999).'.'.$extension;
            //echo $file_name;die;
            Image::make($upload_file)->resize(250,200)->save(public_path('/upload/categories/'.$file_name));
        }else{
            $file_name = null;
        }

        //create category
        Category::create([
            'name' => $data['name'],
            'addedBy' => Auth::id(),
            'image' => $file_name,
        ]);
        return back();
    }

    public function delete($id){
        Category::find($id)->delete();
        return redirect()->route('trash');
    }

    public function restore($id){
        Category::onlyTrashed()->find($id)->restore();
        return back();
    }

    public function force_delete($id){
        $image = Category::onlyTrashed()->where('id',$id)->first()->image;
        if($image){
            $image_path = public_path('upload/categories/'.$image);
            unlink($image_path);
        }

        Category::onlyTrashed()->find($id)->forceDelete();
        return back();
    }
}
