@extends('layouts.dashboard')
@section('content')

<div class="row">
     <div class="col-lg-12">
        <div class="card" style="background: #ebe3e34a;">
            <div class="card-header">
                <h3>Add Product</h3>
            </div>
            <div class="card-body" style="margin-top:-26px;">
                <form action="{{route('product.update',$product->slug)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name" >Select Category</label>
                            <select name="category_id" class="form-control" id="cat_id">
                                <option value="">Select One</option>
                                @foreach($data as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <span style="color:red">@error('category_id') {{$message}} @enderror</span>
                        </div>

                        {{-- ajax sub category select option --}}
                        <div class="col-lg-6">
                            <label for="name" >Select Category</label>
                            <select name="sub_category_id" class="form-control catInfo">
                                <option value="">Select One</option>
                           </select>
                           <span style="color:red">@error('sub_category_id') {{$message}} @enderror</span>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" name="product_name" class="form-control" placeholder="product name" value={{$product->product_name}}>
                                <span style="color:red">@error('product_name') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="number" name="product_price" class="form-control" placeholder="product price" value={{$product->product_price}}>
                                <span style="color:red">@error('product_price') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="number" name="discount" class="form-control" placeholder="Discount %" value={{$product->discount}}>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" name="brand" class="form-control" placeholder="Brand" value={{$product->brand}}>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mt-3">
                                <textarea name="short_desc" id="" cols="30" rows="5" class="form-control" placeholder="short description">{{$product->short_desc}}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mt-3">
                                <textarea name="long_desc" id="summernote" cols="30" rows="5" class="form-control" placeholder="long description">{{$product->long_desc}}</textarea>
                                <span style="color:red">@error('long_desc') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="" class="form-label">Product Preview</label>
                                <input type="file" name="preview" class="form-control">
                                <img src="{{asset('upload/products')}}/{{$product->preview}}" alt="" style="width:200px;">
                                <span style="color:red">@error('preview') {{$message}} @enderror</span>
                            </div>
                        </div>



                    </div>


                    <button class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_section')
<script>
    $("#cat_id").change(function(){
        let catId = $(this).val();
        //alert(catId);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url:'/ajax/subCategory',
            type:'post',
            data:{catId:catId},
            success:function(resp){
                 $(".catInfo").html(resp);
                //alert(resp);
            }
        })

    })
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>

@endsection
