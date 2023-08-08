@extends('front.layouts.main')
@section('page_title', __('Reset Password'))
@section('content')
<!-- breadcrumb area start here   -->
<section class="breadcrumb-area cus-bg-img"  style="background-image: url({{ asset(path_page_banner() . $allsettings['banner']) }})">
    <div class="container">
        <h2 class="page-title">{{ __('main.Reset Password') }}</h2>
        <ul class="breadcrumb-page">
            <li><a href="{{ route('front.index') }}">{{ __('main.Home') }}</a></li>
            <li>{{ __('main.Reset Password') }}</li>
        </ul>
    </div>
</section>
<!-- breadcrumb area end here   -->
<!-- register area star here  -->
<div class="register-area section">
    <div class="container">
        <div class="register-wrap">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="register-image">
                        <img src="{{asset('front/assets/images/register-image.png')}}" alt="{{ __('register-image') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="register-form">
                        <h2 class="form-title">{{ __('main.Reset_Password') }}</h2>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('resetpasswordpost', $token) }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('main.Enter_New_Password') }}" />
                                <i class="fas fa-lock envelope form-icon"></i>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="{{ __('main.Enter_Confirm_Password') }}" />
                                <i class="fas fa-lock envelope form-icon"></i>
                            </div>
                            <div class="form-bottom">
                                <button type="submit" class="primary-btn">{{ __('main.Reset_Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- register area star here  -->
@endsection

