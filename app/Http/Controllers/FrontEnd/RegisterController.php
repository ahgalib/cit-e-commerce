<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customerlogin;
use App\Models\CustomerEmailVerify;
use Hash;
use Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailVerifyNotification;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function customerLoginRegister(){
        return view('front_end.loginRegister');
    }

    public function customerRegister(Request $request){
        Customerlogin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $customer = Customerlogin::where('email',$request->email)->first();
        $customer_info = CustomerEmailVerify::create([
            'customer_id' => $customer->id,
            'token' => uniqid(),
        ]);

        Notification::send($customer, new EmailVerifyNotification($customer_info));
        return back()->with('verify','We have sent you a email verify link! please check your email');

        //Auth::guard('customerlogin')->attempt(['email'=>$request->email,'password'=>$request->password]);

        //return redirect()->name('/');

        //Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
    }

    public function emailVerify($token){
        $customer_info = CustomerEmailVerify::where('token',$token)->first();
        $customer_id = $customer_info->customer_id;
        Customerlogin::where('id',$customer_id)->update([
            'email_verified_at' => Carbon::now()->format('Y-m-d')
        ]);
        $customer_info->delete();
        return redirect()->route('customer.login.register')->with('verifySuccess','Your email verified successfully..Now you can login :) ');
    }


}
