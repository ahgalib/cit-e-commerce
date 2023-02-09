@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-md-11">
        <table class="table">
            <thead>
                <th>SI No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach($data as $key => $user)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->image)
                                <img src="" alt="">
                            @else
                                <img src="{{ Avatar::create($user->name)->toBase64() }}" width="60"/>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-danger m-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
