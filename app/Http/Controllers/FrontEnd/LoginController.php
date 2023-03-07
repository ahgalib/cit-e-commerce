<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Hash;
use Auth;


class LoginController extends Controller
{
    public function customer_login(Request $request){

        //return $request->all();die;
        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            if(Auth::guard('customerlogin')->user()->email_verified_at == null){
                return back()->with('errorVerify','Please first verify your email and then login');
            }else{
                if(Cart::where('customer_id',Auth::guard('customerlogin')->id())->exists()){
                    return redirect()->route('cart');
                }
                else{
                    return redirect('/');
                }
            }

        }else{
            return back()->with('wrongCredential','Wrong Credential');
        }
    }

    public function customerLogout(){
        Auth::guard('customerlogin')->logout();
        return redirect()->route('customer.login.register');
    }
}
