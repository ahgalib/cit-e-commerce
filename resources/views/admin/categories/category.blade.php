@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <table class="table">
            <thead>
                <th>SI No</th>
                <th>Name</th>
                <th>Added By</th>
                <th>Image</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($data as $key => $category)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->rel_to_user->name}}</td>
                        <td>
                            @if($category->image)
                                <img src="{{asset('upload/categories')}}/{{$category->image}}" alt="" style="width:150px;height:90px;">
                            @else
                                <p>No Image Available</p>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Edit</a>
                                    <a class="dropdown-item" href="{{route('category.delete',$category->id)}}">Delete</a>
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
                <h3>Add Category</h3>
            </div>
            <div class="card-body" style="margin-top:-26px;">
                <form action="{{route('category.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="name">
                        <span style="color:red">@error('name') {{$message}} @enderror</span>
                    </div>

                    <div class="mb-2">
                        <label for="name" >Category Image</label>
                        <input type="file" class="form-control" name="image">
                        <span style="color:red">@error('image') {{$message}} @enderror</span>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
