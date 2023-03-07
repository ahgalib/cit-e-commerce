@extends('layouts.front_end_layout.front_end_layout')
@section('content')
<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Checkout<span>Shop</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="checkout">
        <div class="container">
            {{-- <div class="checkout-discount">
                <form action="#">
                    <input type="text" class="form-control" required id="checkout-discount-input">
                    <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                </form>
            </div><!-- End .checkout-discount --> --}}
            <form action="{{route('checkout.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{Auth::guard('customerlogin')->user()->name}}">
                                    <input type="hidden" name="customer_id" value="{{Auth::guard('customerlogin')->id()}}">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Email *</label>
                                    <input type="email" class="form-control" name="email" value="{{Auth::guard('customerlogin')->user()->email}}">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>Company Name (Optional)</label>
                            <input type="text" class="form-control" name="company">

                            <label>Country *</label>
                            <select class="form-control" name="country_id" id="ajaxCountry">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country )

                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>

                            <label>City *</label>
                            <select class="form-control" name="city_id" id="city">
                                <option value="" >Select City</option>
                            </select>

                            <label>Address *</label>
                            <input type="text" class="form-control" name="address" placeholder="House number and Street name" required>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Postcode / ZIP *</label>
                                    <input type="text" class="form-control" name="zip_code">
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Phone *</label>
                                    <input type="tel" class="form-control" name="phone">
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>Order notes (optional)</label>
                            <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery" name="notes"></textarea>


                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                            </div><!-- End .custom-checkbox -->

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                            </div><!-- End .custom-checkbox -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-4">
                        <div class="summary">
                            <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->
                            <table class="table table-summary">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sub_total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td><a href="{{route('product.details',$cart->rel_to_product->slug)}}">{{$cart->rel_to_product->product_name}} </a> X {{$cart->quantity}}
                                            <img src="{{asset('upload/products')}}/{{$cart->rel_to_product->preview}}" style="width:70px;">
                                            Size:{{$cart->rel_to_size->size_name}}
                                            Color:{{$cart->rel_to_color->color_name}}
                                            <td>{{$cart->rel_to_product->after_discount * $cart->quantity}}</td>
                                        </tr>
                                        @php
                                        $sub_total += $cart->rel_to_product->after_discount * $cart->quantity ;
                                    @endphp
                                    @endforeach

                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td class="subTotal">{{session('sub_total')}}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-subtotal">
                                        <td>Discount:</td>
                                        <td>{{session('discount')}}</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr>
                                        <td>Charge:</td>
                                        <td id="charge">0</td>
                                    </tr>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td id="total">$160.00</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <div class="accordion-summary" id="accordion-payment">
                                <h6>Location</h6>

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="rangpur" name="charge" class="custom-control-input charge" value="70">
                                    <label class="custom-control-label" for="rangpur">Rangpur:</label>
                                </div><!-- End .custom-control -->

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="out-side" name="charge" class="custom-control-input charge" value="130">
                                    <label class="custom-control-label" for="out-side">Out Side Rangpur</label>
                                </div><!-- End .custom-control -->
                            </div><!-- End .accordion -->

                            <div class="accordion-summary" id="accordion-payment">
                                <h6>Payment Method</h6>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cash-on" name="payment_method" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="cash-on">Cash On Delivery:</label>
                                </div><!-- End .custom-control -->

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="sslcom" name="payment_method" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="sslcom">SSLCommerz</label>
                                </div><!-- End .custom-control -->

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="bank" name="payment_method" class="custom-control-input" value="3">
                                    <label class="custom-control-label" for="bank">Bank</label>
                                </div><!-- End .custom-control -->
                            </div><!-- End .accordion -->

                            <input type="hidden" name="subtotal" value={{session('sub_total')}}>
                            <input type="hidden" name="discount" value={{session('discount')}}>

                            <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                <span class="btn-text">Place Order</span>
                                <span class="btn-hover-text">Proceed to Checkout</span>
                            </button>
                        </div><!-- End .summary -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </form>
        </div><!-- End .container -->
    </div><!-- End .checkout -->
</div><!-- End .page-content -->
@endsection


@section('footer_script')
<script>
    $(".charge").click(function(){
        let charge = $(this).val();
        let subTotal = $('.subTotal').html();
        let total = parseInt(charge) + parseInt(subTotal)
        $("#charge").html(charge);
        $("#total").html(total);
        //alert(total);
    })
</script>
<script>
    $("#ajaxCountry").change(function(){
        let countryId = $(this).val();
        //alert(countryId);

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url:'/ajax/getCities',
            type:'post',
            data:{countryId:countryId},
            success:function(resp){
                $("#city").html(resp);
            }
        })
    })
</script>
@endsection
