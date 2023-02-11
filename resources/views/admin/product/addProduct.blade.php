@extends('layouts.dashboard')
@section('content')

<div class="row">
     <div class="col-lg-12">
        <div class="card" style="background: #ebe3e34a;">
            <div class="card-header">
                <h3>Add Product</h3>
            </div>
            <div class="card-body" style="margin-top:-26px;">
                <form action="{{route('subCategory.create')}}" method="post">
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
                        </div>

                        {{-- ajax sub category select option --}}
                        <div class="col-lg-6">
                            <label for="name" >Select Category</label>
                            <select name="sub_category_id" class="form-control catInfo">
                                <option value="">Select One</option>
                           </select>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" name="product_name" class="form-control" placeholder="product name">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="number" name="product_price" class="form-control" placeholder="product price">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="number" name="discount" class="form-control" placeholder="Discount % ">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" name="brand" class="form-control" placeholder="Brand">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mt-3">
                                <textarea name="short_desc" id="" cols="30" rows="5" class="form-control" placeholder="short description"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mt-3">
                                <textarea name="long_desc" id="" cols="30" rows="5" class="form-control" placeholder="long description"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="" class="form-label">Product Preview</label>
                                <input type="file" name="product_preview" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3">
                                <label for="" class="form-label">Product Thumbnails</label>
                                <input type="file" name="product_thumbnails" class="form-control">
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
            url:'/ajax/product/store',
            type:'post',
            data:{catId:catId},
            success:function(resp){
                 $(".catInfo").html(resp);
                //alert(resp);
            }
        })

    })
</script>

@endsection
