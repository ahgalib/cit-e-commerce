@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header"> <h2>Trashed Item</h2></div>
            <table class="table">
                <thead>
                    <th>SI No</th>
                    <th>Name</th>
                    <th>Added By</th>
                    <th>Image</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($trash as $key => $category_trash)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$category_trash->name}}</td>
                            <td>{{$category_trash->rel_to_user->name}}</td>
                            <td>
                                @if($category_trash->image)
                                    <img src="{{asset('upload/categories')}}/{{$category_trash->image}}" alt="" style="width:150px;height:90px;">
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
                                        <a class="dropdown-item" href="{{route('category.restore',$category_trash->id)}}">Restore</a>
                                        <a class="dropdown-item" href="{{route('category.force_delete',$category_trash->id)}}">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
