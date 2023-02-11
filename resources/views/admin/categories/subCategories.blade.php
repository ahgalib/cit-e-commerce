@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <table class="table table-striped">
            <thead>
                <th>SI No</th>
                <th>Sub Category Name</th>
                <th>Category Name</th>
                <th>Added By</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($sub_cat as $key => $sub_category)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$sub_category->sub_category_name}}</td>
                        {{-- <td>{!!($sub_category->rel_to_category->deleted_at == NULL?$sub_category->rel_to_category->name:$sub_category->rel_to_category->name)!!}</td>
                        <td>{{$sub_category->rel_to_user->name}}</td> --}}
                        <td>
                            @if($sub_category->rel_to_category->deleted_at == null)
                            null nai
                            @else
                            null pace
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Edit</a>
                                    <a class="dropdown-item" href="">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="col-lg-4">
        <div class="card" style="background: #ebe3e34a;">
            <div class="card-header">
                <h3>Add Sub Category</h3>
            </div>
            <div class="card-body" style="margin-top:-26px;">
                <form action="{{route('subCategory.create')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" >Select Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select One</option>
                            @foreach($data as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="sub_category_name">
                        <span style="color:red">@error('name') {{$message}} @enderror</span>
                    </div>


                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_section')
<script>
    $(".catVal").change(function(){
        let catVal = $(this).val();
       // alert(catVal);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url:'/ajaxSubCategory',
            type:'post',
            data:{catVal:catVal},
            success:function(resp){
                $(".catInfo").html(resp);
            }
        })

    })
</script>

@endsection
