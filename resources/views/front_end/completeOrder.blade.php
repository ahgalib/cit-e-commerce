@extends('layouts.front_end_layout.front_end_layout')
@section('content')
<div class="row p-5 text-center">
    <div class="col-md-12">
        <h4 style="font-weight: bold;">Your Order is Completed!!</h4>
        <p>Your Order {{$order_id}} has been completed.Your order details are shown for your personal account</p>
        <button class="btn btn-dark mt-3"><a href="{{route('shop.home')}}" class="text-light">Shop Again</a> </button>
    </div>
</div>
@endsection
