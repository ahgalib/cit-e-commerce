@extends('layouts.front_end_layout.front_end_layout')
@section('content')

<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{asset('front_end_asset/images/backgrounds/login-bg.jpg')}})">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                        @if(session('passSuccess'))
                            <p style="color:green;font-weight:bold;>{{session('passSuccess')}}</p>
                        @endif
                        @if(session('wrongCredential'))
                            <p style="color:red;font-weight:bold;">{{session('wrongCredential')}}</p>
                        @endif
                        @if(session('errorVerify'))
                            <p style="color:red;font-weight:bold;">{{session('errorVerify')}}</p>
                        @endif
                        <form action="{{ route('customer.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="singin-email-2"> Email address *</label>
                                <input type="email" class="form-control" id="singin-email-2" name="email">
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="singin-password-2">Password *</label>
                                <input type="password" class="form-control" id="singin-password-2" name="password">
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                                    <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                </div><!-- End .custom-checkbox -->

                                <a href="{{route('customer.reset.password')}}" class="forgot-link">Forgot Your Password?</a>
                            </div><!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>
                                        Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-f">
                                        <i class="icon-facebook-f"></i>
                                        Login With Facebook
                                    </a>
                                </div><!-- End .col-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .form-choice -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                        @if(session('verify'))
                            <p style="color:green;font-weight:bold;">{{session('verify')}}</p>
                        @endif
                        @if(session('verifySuccess'))
                        <p style="color:green;font-weight:bold;">{{session('verifySuccess')}}</p>
                    @endif
                        <form action="{{ route('customer.register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Your Name *</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="register-email-2">Your email address *</label>
                                <input type="email" class="form-control" id="register-email-2" name="email">
                            </div><!-- End .form-group -->


                            <div class="form-group">
                                <label for="register-password-2">Password *</label>
                                <input type="password" class="form-control" id="register-password-2" name="password">
                            </div><!-- End .form-group -->



                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SIGN UP</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-policy-2">
                                    <label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>
                                        Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login  btn-f">
                                        <i class="icon-facebook-f"></i>
                                        Login With Facebook
                                    </a>
                                </div><!-- End .col-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .form-choice -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->
</main><!-- End .main -->

@endsection
