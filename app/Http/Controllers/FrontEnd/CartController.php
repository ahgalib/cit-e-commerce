<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('customerlogin');
    }

    public function index(){
        return view('front_end.cart');
    }

    public function storeCart(Request $request){
        Cart::create([
            'customer_id' => Auth::guard('customerlogin')->id(),
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('cart');
    }
}
