<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
}
