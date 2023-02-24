@extends('layouts.dashboard')
@section('content')

<div class="row mb-5">
    <div class="col-lg-12">

        <div>
            <h2 style="margin-bottom:30px">Add Inventory for <span style="color:rgb(0, 132, 255);font-size:29px;">{{$product->product_name}}</span></h2>
            <h4 style="margin-bottom:30px">Product price is {{$product->after_discount}} tk</h4>
            <img src="{{asset('upload/products')}}/{{$product->preview}}" alt="" style="width:200px;">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <h3>Inventory table</h3>
            <table class="table table-striped">
                <thead>
                    <th>SI No</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Stock</th>
                </thead>
                <tbody>
                    @foreach ($inventories as $key=>$inventory)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$inventory->rel_to_product_color->color_name}}<div style="width:30px;height:20px;background:{{$inventory->rel_to_product_color->color_name}}"></div></td>
                            <td>{{$inventory->rel_to_product_size->size_name}}</td>
                            <td>{{$inventory->quantity}}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-header">
            <h3>Add Inventory Form</h3>
        </div>
        <div class="card-body">
            <form action="{{route('product.create.inventory')}}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="mb-3">
                    <label for="name">Select Color</label>
                    <select name="product_color_id" class="form-control" >
                        <option value="">Select One</option>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}">{{$color->color_name}}</option>
                        @endforeach
                    </select>
                    <span style="color:red">@error('product_color_id') {{$message}} @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="name" >Select Size</label>
                    <select name="product_size_id" class="form-control" >
                        <option value="">Select One</option>
                        @foreach($sizes as $size)
                            <option value="{{$size->id}}">{{$size->size_name}}</option>
                        @endforeach
                    </select>
                    <span style="color:red">@error('product_size_id') {{$message}} @enderror</span>
                </div>

                <div class="mb-3">
                    <input type="number" name="quantity" class="form-control" placeholder="enter product quantity">
                    <span style="color:red">@error('quantity') {{$message}} @enderror</span>
                </div>
                <div>
                    <button class="btn btn-primary">Add Inventory</button>
                </div>
            </form>
        </div>
    </div>



</div>

@endsection

