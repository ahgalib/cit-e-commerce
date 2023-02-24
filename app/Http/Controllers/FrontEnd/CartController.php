<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('customerlogin');
    }

    public function index(Request $request){
        $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $coupon = $request->coupon;
        $discount = 0;
        $message = '';
        $type = '';
        if($coupon == ''){
            $discount = 0;
        }
        else{
            if(Coupon::where('coupon_code',$coupon)->exists()){
                if(Carbon::now()->format('Y-m-d') < Coupon::where('coupon_code',$coupon)->first()->validity){
                    //echo "valiidty ace";
                    $discount = Coupon::where('coupon_code',$coupon)->first()->amount;
                    $type =  Coupon::where('coupon_code',$coupon)->first()->type;
                }
                else{
                    //echo "validity nai";
                    $discount = 0;
                    $message = 'Coupon was Expired';
                }
            }
            else{
                $discount = 0;
                $message = 'Invalide Coupon';
            }
        }
        return view('front_end.cart',compact('carts','coupon','message','discount','type'));
    }

    public function storeCart(Request $request){
        if($request->quantity > Inventory::where(['product_id'=>$request->product_id,'product_size_id'=>$request->size_id,'product_color_id'=>$request->color_id])->first()->quantity){
            return back()->with('stock_out','Stock Out');
        }else{
            Cart::create([
                'customer_id' => Auth::guard('customerlogin')->id(),
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart');
    }

    public function deleteCart($id){
       Cart::find($id)->delete();
       return back();
    }

    public function updateCart(Request $request){
        foreach($request->quantity as $key=>$quantity){
            //echo $key.'=>'.$quantity;
            Cart::where('id',$key)->update([
                'quantity' => $quantity,
            ]);
        }
        return back();
    }
}
