@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <table class="table">
            <thead>
                <th>SI No</th>
                <th>Code</th>
                <th>Coupon Type</th>
                <th>Amount</th>
                <th>Validity</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($coupons as $key => $coupon)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$coupon->coupon_code}}</td>
                        @if($coupon->type == 1)
                            <td>Percentage</td>
                        @else
                            <td>Solid Amount</td>
                        @endif
                        <td>{{$coupon->amount}}</td>
                        <td>{{Carbon\Carbon::now()->diffInDays($coupon->validity,false)}}</td>
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
                <h3>Add Coupon</h3>
            </div>
            <div class="card-body" style="margin-top:-26px;">
                <form action="{{route('coupon.create')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="coupon_code" class="form-label">Coupon Code</label>
                        <input type="text" class="form-control" name="coupon_code">
                    </div>

                    <div class="mb-2">
                        <label for="type" >Coupon Type</label>
                        <select name="type" class="form-control">
                            <option value="">Select cpupon type</option>
                            <option value="1">Percentage</option>
                            <option value="2">Solid Amount</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="form-label">Coupon Amount</label>
                        <input type="number" class="form-control" name="amount">
                    </div>

                    <div class="mb-4">
                        <label for="validity" class="form-label">Coupon Validity</label>
                        <input type="date" class="form-control" name="validity">
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
