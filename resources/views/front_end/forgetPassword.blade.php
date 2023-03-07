@extends('layouts.front_end_layout.front_end_layout')
@section('content')

<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{asset('front_end_asset/images/backgrounds/login-bg.jpg')}})">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Forget Password </a>
                    </li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                        @if (session('send'))
                            <span style="color:green;">{{session('send')}}</span>
                        @endif
                        <form action="{{route('customer.reset.password.send')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="singin-email-2"> Email address *</label>
                                <input type="email" class="form-control" id="singin-email-2" name="email">
                            </div><!-- End .form-group -->
                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>Reset Password</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->
</main><!-- End .main -->

@endsection
