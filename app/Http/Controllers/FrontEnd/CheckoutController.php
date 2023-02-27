<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\TblCountry;
use App\Models\City;
use App\Models\Order;
use App\Models\BillingDetail;
use App\Models\OrderProduct;
use App\Models\Inventory;
use App\Mail\InvoiceMail;
use App\Mail\InvoiceTrap;
use Auth;
use Str;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index(){
        $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $countries = TblCountry::all();

        return view('front_end.checkout',compact('carts','countries',));
    }

    public function getCities(Request $request){
        //echo $request->countryId;
        $cities = City::where('country_id',$request->countryId)->get();
        $option = '<option value="">Select City</option>';
        foreach($cities as $city){
            $option.= "<option value='{$city->id}'>".$city->name.'</option>';
        }
        echo $option;
    }

    public function checkoutStore(Request $request){
        if($request->payment_method == 1){
            //echo "cash on delevery";
            $order_id = '#'.Str::upper(Str::random(3)).'-'.rand(000000,999999);
            Order::create([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customerlogin')->id(),
                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'charge' => $request->charge,
                'total' => $request->subtotal + $request->charge,
                'payment_method' => $request->payment_method
            ]);

            BillingDetail::create([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customerlogin')->id(),
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company,
                'phone' => $request->phone,
                'address' => $request->address,
                'zip_code' => $request->zip_code,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'notes' => $request->notes,

            ]);

            $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
            foreach($carts as $cart){
                OrderProduct::create([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customerlogin')->id(),
                    'product_id' => $cart->product_id,
                    'price' => $cart->rel_to_product->after_discount,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                ]);

                Inventory::where(['product_id'=>$cart->product_id,'product_color_id'=>$cart->color_id,'product_size_id'=>$cart->size_id])->decrement('quantity',$cart->quantity);
            }
            //Invoice
           // Mail::to($request->email)->send(new InvoiceMail($order_id));


            Cart::where('customer_id',Auth::guard('customerlogin')->id())->delete();

            return redirect()->route('order.complete')->withOrder($order_id);
        }
        else if($request->payment_method == 2){
            $data = $request->all();
            // return $data;die;
            return redirect()->route('pay')->with('data',$data);
        }
        else{
            echo "stripe or bank";
        }
    }

    public function orderComplete(){
        if(session('order')){
            $order_id = session('order');
            return view('front_end.completeOrder',compact('order_id'));
        }else{
           abort('404');
        }

    }
}
