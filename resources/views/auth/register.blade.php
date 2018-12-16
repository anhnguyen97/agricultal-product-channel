@extends('channel.layouts.master')
@section('css')
@include('channel.layouts.css') 
<link rel="stylesheet" href="{{ asset('shop/styles/bootstrap4/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/responsive.css') }}">   
<link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_styles.css') }}">
@endsection

@section('navigation')
@include('channel.layouts.navigation')
@endsection

@section('content')
<div class="container single_product_container">
    <div class="row">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs d-flex flex-row align-items-center">
            <ul>
                <li><a href="{{ route('channel.index') }}">Home</a></li>
                {{-- <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a></li> --}}
                <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Đăng ký tài khoản</a></li>
            </ul>
        </div>
    </div>
    <div class="container justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('Register') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Họ và tên') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Loại tài khoản') }}</label>

                        <div class="col-md-6">
                            <select name="is_farmer" id="is_farmer" class="form-control" required="required">
                                <option value="1">Nông dân</option>
                                <option value="0">Thương lái</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khâủ') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@include('channel.layouts.js')
@endsection
