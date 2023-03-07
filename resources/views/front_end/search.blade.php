@extends('layouts.front_end_layout.front_end_layout')
@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Grid 4 Columns</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-info">
                            <h3>Search Product Found</h3>
                            Showing <span>9 of 56</span> Products
                        </div><!-- End .toolbox-info -->
                    </div><!-- End .toolbox-left -->

                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control">
                                    <option value="popularity" selected="selected">Most Popular</option>
                                    <option value="rating">Most Rated</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                        </div><!-- End .toolbox-sort -->

                    </div><!-- End .toolbox-right -->
                </div><!-- End .toolbox -->

                <div class="products mb-3">
                    <div class="row justify-content-center">
                        @forelse($search_products as $search)
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <div class="product product-7 text-center">
                                    <figure class="product-media">

                                        @if($search->discount)
                                        <span class="product-label label-new bg-warning" style="font-size:15px;">{{$search->discount}}% off</span>
                                        @endif
                                        <a href="product.html">
                                            <img src="{{asset('upload/products')}}/{{$search->preview}}" alt="Product image" class="product-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                        </div><!-- End .product-action-vertical -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">{{$search->rel_to_cate->name}}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="product.html">{{$search->product_name}}</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                           TK. {{$search->after_discount}}
                                        </div><!-- End .product-price -->
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">( 2 Reviews )</span>
                                        </div><!-- End .rating-container -->

                                        <div class="product-nav product-nav-thumbs">
                                            @foreach($search->rel_to_thumb as $product_thumb)
                                                <a href="#" class="active">
                                                    <img src="{{asset('upload/thumbnails')}}/{{$product_thumb->thumbnail}}" alt="product desc">
                                                </a>
                                            @endforeach
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                        @empty
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <div class="product product-7 text-center">
                                    <h3 style="color:red;">No Search Found  :( </h3>
                                </div>
                            </div>
                        @endforelse

                    </div><!-- End .row -->
                </div><!-- End .products -->


                <nav aria-label="Page navigation">
                    {{-- {{$search_products->links()}} --}}
                </nav>
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3 order-lg-first">
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-clean">
                        <label>Filters:</label>
                        <a href="#" class="sidebar-filter-clear">Clean All</a>
                    </div><!-- End .widget widget-clean -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                Price
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-5">
                            <div class="widget-body">
                                <div class="filter-price">
                                    <div class="filter-price-text">
                                        Price Range:

                                        <input type="number" class="form-control" id="p_min"  placeholder="min">
                                        <input type="number" class="form-control" id="p_max"  placeholder="max">
                                    </div><!-- End .filter-price-text -->
                                    <div>
                                        <button class="brn brn-warning" id="btn_price">See</button>
                                    </div>
                                    <div id="price-slider"></div><!-- End #price-slider -->
                                </div><!-- End .filter-price -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                Category
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-1">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach($category as $categories)
                                        <div class="filter-item">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="category_id" name="category" id="cat-{{$categories->id}}" value="{{$categories->id}}"
                                                {{$categories->id == @$_GET['cat']?'checked':''}}
                                                >
                                                <label class="custom-control-label" for="cat-{{$categories->id}}">{{$categories->name}}</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{App\Models\Product::where('category_id',$categories->id)->count()}}</span>
                                        </div><!-- End .filter-item -->
                                    @endforeach

                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                Size
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-2">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach($size as $sizes)
                                        <div class="filter-item">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="size_id"  id="size-{{$sizes->id}}" value="{{$sizes->id}}"
                                                {{$sizes->id == @$_GET['size']?'checked':''}}
                                                >
                                                <label class="custom-control-label" for="size-{{$sizes->id}}">{{$sizes->size_name}}</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{App\Models\Product::where('category_id',$sizes->id)->count()}}</span>
                                        </div><!-- End .filter-item -->
                                    @endforeach

                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                Colour
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-3">
                            <div class="widget-body">
                                <div class="filter-colors">
                                    @foreach ($color as $colors)

                                    <input type="radio" class="color_id" name="color" id="cat-{{$colors->id}}" value="{{$colors->id}}"hidden
                                    {{$colors->id == @$_GET['color']?'checked':''}}>
                                    <label class="custom-control-label rounded-circle" for="cat-{{$colors->id}}">
                                        @if($colors->id == @$_GET['color'])
                                            <a style="background: {{$colors->color_name}};border:3px solid black"><span class="sr-only">Color Name</span></a>
                                        @else
                                            <a style="background: {{$colors->color_name}}"><span class="sr-only">Color Name</span></a>
                                        @endif
                                    </label>

                                    @endforeach

                                </div><!-- End .filter-colors -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                Brand
                            </a>
                        </h3><!-- End .widget-title -->

                        <div class="collapse show" id="widget-4">
                            <div class="widget-body">
                                <div class="filter-items">
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-1">
                                            <label class="custom-control-label" for="brand-1">Next</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-2">
                                            <label class="custom-control-label" for="brand-2">River Island</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-3">
                                            <label class="custom-control-label" for="brand-3">Geox</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-4">
                                            <label class="custom-control-label" for="brand-4">New Balance</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-5">
                                            <label class="custom-control-label" for="brand-5">UGG</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-6">
                                            <label class="custom-control-label" for="brand-6">F&F</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-7">
                                            <label class="custom-control-label" for="brand-7">Nike</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .filter-item -->

                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->


                </div><!-- End .sidebar sidebar-shop -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .page-content -->

@endsection


@section('footer_script')
<script>
    $("#search_btn").click(function(){
        let search_input = $("#search_input").val();
        let min = $("#p_min").val();
        let max = $("#p_max").val();
        let category_id = $('input[class="category_id"]:checked').attr('value');
        let color_id = $('input[class="color_id"]:checked').attr('value');
        let size_id = $('input[class="size_id"]:checked').attr('value');
        //alert(size_id);
        let link = "{{route('search')}}" + "?q=" + search_input + "&min=" + min + "&max=" + max + "&cat=" + category_id + "&color=" + color_id + "&size=" + size_id;
        window.location.href = link;
    })
    //Click min and max button
    $("#btn_price").click(function(){
        let search_input = $("#search_input").val();
        let min = $("#p_min").val();
        let max = $("#p_max").val();
        let category_id = $('input[class="category_id"]:checked').attr('value');
        // alert(min);
        let link = "{{route('search')}}" + "?q=" + search_input + "&min=" + min + "&max=" + max + "&cat=" + category_id;
        window.location.href = link;
    })
</script>

@endsection


