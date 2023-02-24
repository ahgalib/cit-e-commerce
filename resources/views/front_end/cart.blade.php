@extends('layouts.front_end_layout.front_end_layout')
@section('content')

<div class="page-header text-center" style="background-image: url({{asset('front_end_asset/images/page-header-bg.jpg')}})">
    <div class="container">
        <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <form action="{{route('cart.update')}}" method="post">
                    @csrf

                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $sub_total = 0;
                                @endphp
                                @foreach($carts as $cart)
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{asset('upload/products')}}/{{$cart->rel_to_product->preview}}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="{{$cart->rel_to_product->product_name}}">{{$cart->rel_to_product->product_name}}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">{{$cart->rel_to_product->after_discount}}</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity d-flex">
                                            <p class="mr-4">{{$cart->quantity}}</p>
                                            <input type="number" class="form-control" name="quantity[{{$cart->id}}]" min="1" max="10" step="1" data-decimals="0" required>
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col">{{$cart->rel_to_product->after_discount * $cart->quantity}}</td>
                                    <td class="remove-col"><a href="{{route('cart.delete',$cart->id)}}" class="btn-remove"><i class="icon-close"></i></a></td>
                                </tr>
                                @php
                                    $sub_total += $cart->rel_to_product->after_discount * $cart->quantity
                                @endphp
                                @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                        <button class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                    </form>


                    <div class="cart-bottom mt-5">
                        <div class="cart-discount">
                            @if($message)
                                <p style="color:red;font-size:20px;">{{$message}}</p>
                            @endif
                            <form action="{{route('cart')}}" method="get">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="coupon" value="{{$coupon}}" placeholder="enter your coupon">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- End .input-group -->
                            </form>
                        </div><!-- End .cart-discount -->
                    </div><!-- End .cart-bottom -->
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3">
                    <div class="summary summary-cart">
                        <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                        <table class="table table-summary">
                            <tbody>
                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td>{{$sub_total}}  TK.</td>

                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-subtotal">
                                    <td>Discount:</td>
                                    @if($type == 1)
                                    <td>
                                        {{$discount = $sub_total * $discount /100 }} TK.
                                    </td>
                                    @else
                                    <td> {{$discount}} TK.</td>

                                    @endif
                                    {{-- <td>{{$discount}}</td> --}}

                                </tr><!-- End .summary-subtotal -->
                                <tr class="summary-shipping">
                                    <td>Shipping:</td>
                                    <td>&nbsp;</td>
                                </tr>

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
                                            <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$0.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input">
                                            <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$10.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="express-shipping" name="shipping" class="custom-control-input">
                                            <label class="custom-control-label" for="express-shipping">Express:</label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>$20.00</td>
                                </tr><!-- End .summary-shipping-row -->

                                <tr class="summary-shipping-estimate">
                                    <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                    <td>&nbsp;</td>
                                </tr><!-- End .summary-shipping-estimate -->

                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td>{{$sub_total - $discount}} TK.</td>
                                </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        @php
                        $sub_total = $sub_total - $discount;
                          session([
                            "discount" => $discount,
                            'sub_total' => $sub_total
                        ]);
                        @endphp

                        <a href="{{route('checkout')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                    </div><!-- End .summary -->

                    <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->

@endsection
