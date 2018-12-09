<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Channel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->  
    {{-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> --}}


    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/bower_components/bootstrapv4.0/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate/animate.css') }}">
    <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/bower_components/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admins/bower_components/select2/dist/css/select2.min.css') }}">
    <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="css/util.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="css/main.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main_login_user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login_util_user.css') }}">
    <!--===============================================================================================-->
</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Sign In
                    </span>
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ asset('') }}/login">
                    @csrf

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Enter email">
                        <span class="focus-input100"></span>
                    </div>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" placeholder="Enter password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                        <span class="focus-input100"></span>
                    </div>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            {{-- <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label> --}}
                            <input class="input-checkbox100" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label label-checkbox100" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div>
                            <a href="{{ route('password.request') }} class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <!--===============================================================================================-->


    <!--===============================================================================================-->

    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="{{ asset('admins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('admins/bower_components/bootstrapv4.0/js/popper.js') }}"></script>
    <script src="{{ asset('admins/bower_components/bootstrapv4.0/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('admins/bower_components/select2/dist/js/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script src="{{ asset('admins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}
    <!--===============================================================================================-->
    <script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>