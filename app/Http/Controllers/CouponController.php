<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::all();
        return view('admin.coupon.coupon',compact('coupons'));
    }

    public function create(Request $request){
        Coupon::insert([
            'coupon_code' => $request->coupon_code,
            'type' => $request->type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'created_at' => Carbon::now()
        ]);
        return back();
    }
}
