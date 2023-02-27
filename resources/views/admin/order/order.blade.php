@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-12">
       <div class="card">
            <table class="table table-striped">
                <thead>
                    <th>SI No</th>
                    <th>Order Id</th>
                    <th>Customer Id</th>
                    <th>Subtotal</th>

                    <th>Discount</th>

                    <th>Charge</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$order->order_id}}</td>
                            <td>{{$order->customer_id}}</td>
                            <td>{{$order->subtotal}}</td>
                            <td>{{$order->discount}}</td>
                            <td>{{$order->charge}}</td>
                            <td>{{$order->total}}</td>
                            @if($order->payment_method == 1)
                                <td>Cash On Delivery</td>
                            @elseif($order->payment_method == 2)
                                <td>SSL Commerce</td>
                            @else
                                <td>Striped</td>
                            @endif

                            @if($order->status == 0)
                                <td>Placed</td>
                            @elseif($order->status == 1)
                                <td>Packaging</td>

                            @elseif($order->status == 2)
                                <td>Shipped</td>

                            @elseif($order->status == 3)
                                <td>Ready To Deliver</td>
                            @else
                                <td>Delivered</td>
                            @endif

                            <td>
                                <form action="{{route('order.status')}}" method="post">
                                    @csrf
                                <div class="dropdown">
                                    <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" type="submit" name="status" value="{{$order->order_id.','.'0'}}">Placed</button>
                                        <button class="dropdown-item" type="submit" name="status" value="{{$order->order_id.','.'1'}}">Packaging</button>
                                        <button class="dropdown-item" type="submit" name="status" value="{{$order->order_id.','.'2'}}">Shipped</button>
                                        <button class="dropdown-item" type="submit" name="status" value="{{$order->order_id.','.'3'}}">Ready To Deliver</button>
                                        <button class="dropdown-item" type="submit" name="status" value="{{$order->order_id.','.'4'}}">Delivered</button>
                                    </div>
                                </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       </div>
    </div>

@endsection
