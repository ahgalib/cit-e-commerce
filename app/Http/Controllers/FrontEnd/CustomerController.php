<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CusPasswordReset;
use App\Models\Customerlogin;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CustomerPassResetNotification;

class CustomerController extends Controller
{
    public function index(){
        $orders = Order::where('customer_id',Auth::guard('customerlogin')->user()->id)->get();
        //echo $orders;die;
        return view('front_end.customerProfile',compact('orders'));
    }

    public function invoiceDownload($order_id){
        $order_info = Order::find($order_id);
        $order_main_id = $order_info->order_id;
        $pdf = Pdf::loadView('front_end.pdfInvoice',[
            'order_main_id' => $order_main_id,
        ]);
        return $pdf->download('invoice.pdf');
       // return view('front_end.pdfInvoice');
    }

    public function customer_reset_password(){
        return view('front_end.forgetPassword');
    }

    public function customer_reset_password_send(Request $request){
        $customer_info = Customerlogin::where('email',$request->email)->firstOrFail();
        //delete old token from this customer
        CusPasswordReset::where('customer_id',$customer_info->id)->delete();

        $customer_inserted_info = CusPasswordReset::create([
            'customer_id' => $customer_info->id,
            'token' => uniqid(),
        ]);

        Notification::send($customer_info, new CustomerPassResetNotification($customer_inserted_info));
        return back()->with('send','We have sent you a password reset link! please check your email');
    }

    public function customer_reset_password_form($token){
        return view('front_end.passwordResetForm',[
            'token'=>$token
        ]);
    }

    public function customer_update_forget_password_form(Request $request){
        $token = $request->token;
        $customer_info = CusPasswordReset::where('token',$token)->first();
        $customer_id = $customer_info->customer_id;
        Customerlogin::where('id',$customer_id)->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('customer.login.register')->with('passSuccess','Password Reset Successfully done..Now you can login with your new password');
    }
}
