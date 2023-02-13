@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-6">
        <h3>Color's table</h3>
        <table class="table">
            <thead>
                <th>SI No</th>
                <th>color Name</th>
                <th>color</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($colors as $key => $color)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$color->color_name}}</td>
                        <td><div style="width:40px;height:30px;background:{{$color->color_name}}">{{($color->color_name=='N/A'?'N/A':'')}}</div></td>
                         <td><button class="btn btn-danger">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <div class="card" style="background: #dfd9d94a;">
            <div class="card-header">
                <h3>Add Color</h3>
            </div>
            <div class="card-body" style="margin-top:-26px;">
                <form action="{{route('product.color.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="color_name" >Color Name</label>
                        <input type="text" name="color_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="color_code" >Color Code</label>
                        <input type="text" name="color_code" class="form-control">
                    </div>


                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <h3>Size's table</h3>
        <table class="table">
            <thead>
                <th>SI No</th>
                <th>Product Size</th>

                <th>Action</th>
            </thead>
            <tbody>
                @foreach($sizes as $key => $size)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$size->size_name}}</td>

                         <td><button class="btn btn-danger">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <div class="card" style="background: #ebe3e34a;">
            <div class="card-header">
                <h3>Add Size</h3>
            </div>
            <div class="card-body" style="margin-top:-26px;">
                <form action="{{route('product.size.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="size_name" >Size Name</label>
                        <input type="text" name="size_name" class="form-control">
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
