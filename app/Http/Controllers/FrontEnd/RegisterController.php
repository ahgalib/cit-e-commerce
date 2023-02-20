<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customerlogin;
use Hash;
use Auth;

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

        Auth::guard('customerlogin')->attempt(['email'=>$request->email,'password'=>$request->password]);

        return redirect()->name('/');

        //Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
    }


}
