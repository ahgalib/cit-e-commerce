@extends('layouts.front_end_layout.front_end_layout')
@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
        </ol>

        <nav class="product-pager ml-auto" aria-label="Product">
            <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                <i class="icon-angle-left"></i>
                <span>Prev</span>
            </a>

            <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                <span>Next</span>
                <i class="icon-angle-right"></i>
            </a>
        </nav><!-- End .pager-nav -->
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="product-details-top">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery product-gallery-vertical">
                        <div class="row">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{asset('upload/products')}}/{{$product->preview}}" data-zoom-image="{{asset('front_end_asset/images/products/single/1-big.jpg')}}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery active" class="product-image-gallery">
                                @foreach($product_thumbnails as $product_thumbnail)
                                <a class="product-gallery-item" href="#" data-image="{{asset('upload/thumbnails')}}/{{$product_thumbnail->thumbnail}}" data-zoom-image="{{asset('upload/thumbnails')}}/{{$product_thumbnail->thumbnail}}">
                                    <img src="{{asset('upload/thumbnails')}}/{{$product_thumbnail->thumbnail}}" alt="product side">
                                </a>
                                @endforeach

                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .row -->
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->


                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{$product->product_name}}</h1><!-- End .product-title -->
                        <div class="d-flex">
                            @if($product->discount != null)
                                <h5 class="product-title">{{$product->product_price}}</h5>
                                <div style="width:60px;height:2px;background:red;margin-left:-70px;margin-top:10px;"></div>
                                <h5 class="product-title" style="color:red;margin-left:20px;">{{$product->after_discount}} .tk</h5>
                            @else
                                <h5 class="product-title">{{$product->product_price}}</h5>
                            @endif
                        </div>
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                        </div><!-- End .rating-container -->

                        <div class="product-price">
                            {{$product->price}}
                        </div><!-- End .product-price -->

                        <div class="product-content">
                            @if($product->short_desc)
                                <p>{{$product->short_desc}}</p>
                            @endif
                        </div><!-- End .product-content -->

                        <div class="details-filter-row details-row-size">
                            <label>Color:</label>

                            <div class="product-nav product-nav-thumbs">
                                @foreach ($product_color as $product_colors)
                                    {{-- <a href="#" class="active">
                                        <img src="{{asset('front_end_asset/images/products/single/1-thumb.jpg')}}" alt="product desc">
                                    </a> --}}
                                    <div class="form-check form-option form-check-inline mb-1">
                                        <input type="radio" value="{{$product_colors->product_color_id}}" class="form-check-input colorId" id="white{{$product_colors->product_color_id}}" class="" >
                                        <label class="form-option-label rounded-circle" for="white{{$product_colors->product_color_id}}"><span class="form-option-color rounded-circle blc7" style="background: {{$product_colors->rel_to_product_color->color_name}}"></span></label>
                                    </div>
                                @endforeach

                            </div><!-- End .product-nav -->
                        </div><!-- End .details-filter-row -->

                        <form action="{{route('cart.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom">
                                    <select name="size_id" id="size" class="form-control ajaxSize" required>
                                        <option value="">Select a size</option>
                                        <option value="">Please Select a color First</option>
                                    </select>
                                </div><!-- End .select-custom -->

                                <div class="select-custom">
                                    <select name="color_id" id="color" class="form-control colorId" required>
                                        <option value="">Select a Color</option>
                                        @foreach ($product_color as $product_colors)

                                            <option value="{{$product_colors->product_color_id}}">{{$product_colors->rel_to_product_color->color_name}}</option>
                                        @endforeach
                                    </select>
                                </div><!-- End .select-custom -->

                                <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" name="quantity" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->
                            @if(session('stock_out'))
                                <span style="color:red;">{{session('stock_out')}}</span>
                            @endif
                            <div class="product-details-action">

                                <button type="submit" class="btn-product btn-cart" name="check_button" value="1"><span>add to cart</span></button>
                                <div class="details-action-wrapper">
                                    <button type="submit" class="btn-product btn-cart" name="check_button" value="2"><span>add to wishlist</span></button>
                                    <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                </div><!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->


                        </form>   {{-- end cart form --}}


                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a href="#">{{$category->rel_to_cate->name}}</a>,
                                @foreach ($sub_cat as $sub_cats)
                                    <a href="#">{{$sub_cats->rel_to_sub_cat->sub_category_name}}</a>,
                                @endforeach

                            </div><!-- End .product-cat -->

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div>
                        </div><!-- End .product-details-footer -->
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-6 -->

            </div><!-- End .row -->
        </div><!-- End .product-details-top -->

        <div class="product-details-tab">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <h3>Product Information</h3>
                        <p>{{$product->long_desc}} </p>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <h3>Information</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                        <h3>Fabric & care</h3>
                        <ul>
                            <li>Faux suede fabric</li>
                            <li>Gold tone metal hoop handles.</li>
                            <li>RI branding</li>
                            <li>Snake print trim interior </li>
                            <li>Adjustable cross body strap</li>
                            <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                        </ul>

                        <h3>Size</h3>
                        <p>one size</p>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <h3>Delivery & returns</h3>
                        <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                        We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    @if(Auth::guard('customerlogin'))
                        @if(App\Models\OrderProduct::where(['customer_id'=>Auth::guard('customerlogin')->id(),'product_id' => $product->id])->exists())
                            @if(App\Models\OrderProduct::where(['customer_id'=>Auth::guard('customerlogin')->id(),'product_id' => $product->id,'review'=>null])->first())
                                <form action="">
                                    <div class="d-flex ">
                                        <input type="text" class="form-control" name="name" value="{{Auth::guard('customerlogin')->user()->name}}">
                                        <input type="text" class="form-control"  name="email" value="{{Auth::guard('customerlogin')->user()->email}}">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name">Your Review *</label>
                                        <textarea type="text" class="form-control" name="review"></textarea>
                                    </div><!-- End .form-group -->

                                </form>
                            @else
                                <p>You already review this product</p>
                            @endif

                        @else
                            <p>PLease First buy the product and then review it</p>
                        @endif

                    @else
                        <a href="{{route('customer.login.register')}}" class="btn btn-primary mb-2">Please Login to Place a review</a>
                    @endif
                    <div class="reviews">
                        <h3>Reviews (2)</h3>
                        <div class="review">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <h4><a href="#">Samanta J.</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 70%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                    </div><!-- End .rating-container -->
                                    <span class="review-date">6 days ago</span>
                                </div><!-- End .col -->
                                <div class="col">
                                    <h4>Good, perfect size</h4>

                                    <div class="review-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                    </div><!-- End .review-content -->

                                    <div class="review-action">
                                        <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                        <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                    </div><!-- End .review-action -->
                                </div><!-- End .col-auto -->
                            </div><!-- End .row -->
                        </div><!-- End .review -->


                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
            data-owl-options='{
                "nav": false,
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
                    },
                    "480": {
                        "items":2
                    },
                    "768": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    },
                    "1200": {
                        "items":4,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>
            @foreach ($related_product as $related_pro)


            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-new">New</span>
                    <a href="{{route('product.details',$related_pro->slug)}}">
                        <img src="{{asset('upload/products')}}/{{$related_pro->preview}}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="{{route('cart')}}" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">Women</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="{{route('product.details',$related_pro->slug)}}">Brown paperbag waist <br>pencil skirt</a></h3><!-- End .product-title -->
                    <div class="product-price">
                        {{$related_pro->product_price}}
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div><!-- End .rating-container -->

                    <div class="product-nav product-nav-thumbs">
                        @foreach($related_pro->rel_to_thumb as $thumb)
                        <a href="{{route('product.details',$related_pro->slug)}}" class="active">
                            <img src="{{asset('upload/thumbnails')}}/{{$thumb->thumbnail}}" alt="product desc">
                        </a>
                       @endforeach
                    </div><!-- End .product-nav -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->
            @endforeach

        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
</div><!-- End .page-content -->

@endsection

@section('footer-script')
<script>
    $(".colorId").click(function(){
        let colorId = $(this).val();
        let productId = '{{$product->id}}';
        //alert(productId)

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url:'/ajax/product/veriant',
            type:'post',
            data:{colorId:colorId,productId:productId},
            success:function(resp){
                $(".ajaxSize").html(resp);
            }
        })
    })
</script>

@endsection
