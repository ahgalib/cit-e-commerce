<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlists = Wishlist::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('front_end.wishlist',compact('wishlists'));
    }
}
