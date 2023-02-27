<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.order.order',compact('orders'));
    }

    public function orderStatus(Request $request){
        $status =  $request->status;
        $after_explode = explode(',',$status);
        $order_id = $after_explode[0];
        $order_status = $after_explode[1];

        Order::where('order_id',$order_id)->update([
            'status' => $order_status
        ]);
        return back();
    }
}
