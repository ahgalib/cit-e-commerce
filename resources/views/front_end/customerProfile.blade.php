@extends('layouts.front_end_layout.front_end_layout')
@section('content')
<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">My Account<span>Shop</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Account</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <aside class="col-md-4 col-lg-3">
                    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sign Out</a>
                        </li>
                    </ul>
                </aside><!-- End .col-lg-3 -->

                <div class="col-md-8 col-lg-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"           aria-labelledby="tab-dashboard-link">
                            <div class="d-flex">
                                @if(Auth::guard('customerlogin')->user()->photo)
                                    <img src="{{Auth::guard('customerlogin')->user()->photo}}" width="80"/>
                                @else
                                    <img src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64() }}" width="80" />
                                @endif
                                <h4 style="margin-top:20px;margin-left:10px;">{{Auth::guard('customerlogin')->user()->name}}</h4>
                            </div>

                            <div class="mt-3">
                                <h5>{{Auth::guard('customerlogin')->user()->email}}</h5>
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="" class="form-label">Country</label>
                                <input type="text" name="country" class="form-control">
                            </div>
                        </div>


                        <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                            @foreach ($orders as $order)

                            <div class="">
                                <div class="d-flex justify-content-between">
                                    <h4>Order Id{{$order->order_id}} <p>{{$order->created_at->format('d.m-Y')}}</p></h4>
                                    <div><button class="btn-warinig"><a href="{{route('invoice.download',$order->id)}}">Download Pdf</a></button></div>
                                    <div>
                                        <h6>Total (discount + charge) {{$order->total}} TK.</h6>
                                        <h5>Status :
                                        @if($order->status == 0)
                                            Placed
                                        @elseif($order->status == 1)
                                            Packaging

                                        @elseif($order->status == 2)
                                            Shipped

                                        @elseif($order->status == 3)
                                            Ready To Deliver
                                        @else
                                            Delivered
                                        @endif</h5>
                                    </div>
                                </div>
                                @foreach (App\Models\OrderProduct::where('order_id',$order->order_id)->get() as $order_product )


                                <div class="mt-2 mb-4 d-flex">
                                    <div class="mr-3">
                                         <img src="{{asset('upload/products')}}/{{$order_product->rel_to_product->preview}}" alt="" style="width:130px;height:160px;">
                                    </div>
                                    <div class="">
                                        <p>Product Name : {{$order_product->rel_to_product->product_name}}</p>
                                        <p>Quantity : {{$order_product->quantity}}</p>
                                        <p>Unit Price : {{$order_product->price}}</p>

                                        <p>Color : {{$order_product->rel_to_product_color->color_name}}</p>
                                        <p>Size : {{$order_product->rel_to_product_size->size_name}}</p>
                                        <p>Data: {{$order_product->created_at->format('d.m-Y')}}</p>
                                    </div>

                                </div>
                                @endforeach
                            </div>

                            @endforeach
                        </div><!-- .End .tab-pane -->
                    </div>
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .dashboard -->
</div><!-- End .page-content -->
@endsection
