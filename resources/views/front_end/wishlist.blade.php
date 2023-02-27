@extends('layouts.front_end_layout.front_end_layout')
@section('content')


<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
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

                                @foreach($wishlists as $wishlist)
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{asset('upload/products')}}/{{$wishlist->rel_to_product->preview}}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="{{$wishlist->rel_to_product->product_name}}">{{$wishlist->rel_to_product->product_name}}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">{{$wishlist->rel_to_product->after_discount}}</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity d-flex">
                                            <p class="mr-4">{{$wishlist->quantity}}</p>
                                            <input type="number" class="form-control" name="quantity[{{$wishlist->id}}]" min="1" max="10" step="1" data-decimals="0" required>
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col">{{$wishlist->rel_to_product->after_discount * $wishlist->quantity}}</td>
                                    <td class="remove-col"><a href="" class="btn-remove"><i class="icon-close"></i></a></td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                        <button class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                    </form>



                </div><!-- End .col-lg-9 -->

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->

@endsection
