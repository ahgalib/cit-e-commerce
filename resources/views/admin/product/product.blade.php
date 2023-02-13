@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <table class="table table-striped">
                <thead>
                    <th>SI No</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Discount</th>

                    <th>Brand</th>
                    <th>Image</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($product as $key => $products)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$products->rel_to_cate->name}}</td>
                            <td>{{$products->rel_to_sub_cat->sub_category_name}}</td>
                            <td>{{$products->product_name}}</td>
                            <td>{{$products->product_price}}</td>
                            <td>{{($products->discount ? $products->discount.' %' : 'no discount')}}</td>

                            <td>{{($products->brand ? $products->brand: 'no brand')}}</td>
                            <td>
                                <img src="{{asset('upload/products')}}/{{$products->preview}}" alt="" style="width:70px;height:50px;">
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/edit">Edit</a>
                                        <a class="dropdown-item" href="">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       </div>
    </div>

@endsection
