<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    public function index(){
        $data = User::all();
        return view('admin.user',compact('data'));
    }

    public function delete($id){
        User::find($id)->delete();
        return back();
    }
}
