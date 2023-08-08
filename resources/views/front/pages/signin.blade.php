@extends('front.layouts.main')
@section('page_title', __('Sign In'))
@section('content')
    <!-- breadcrumb area start here   -->
    <section class="breadcrumb-area cus-bg-img"
        style="background-image: url({{ asset(path_page_banner() . $allsettings['banner']) }})">
        <div class="container">
            <h2 class="page-title">{{ __('main.Sign_In') }}</h2>
            <ul class="breadcrumb-page">
                <li><a href="{{ route('front.index') }}">{{ __('main.Home') }}</a></li>
                <li>{{ __('main.Sign_In') }}</li>
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
                            <img src="{{ asset('front/assets/images/register-image.png') }}"
                                alt="{{ __('register-image') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="register-form">
                            <h2 class="form-title">{{ __('main.Sign_In') }}</h2>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="{{ __('main.Enter_Email') }}" />
                                    <i class="fas fa-envelope form-icon"></i>
                                    <span class="text-danger">{{ __($errors->first('email')) }}</span>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="{{ __('main.Enter_Password') }}" />
                                    <i class="fas fa-lock form-icon"></i>
                                    <span class="text-danger">{{ __($errors->first('password')) }}</span>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="Agree">
                                    <label class="form-check-label" for="Agree" id="item_checkbox" name="item_checkbox"
                                        value="option1">{{ __('main.Keep_Remember') }}</label>
                                    <a href="{{ route('forgetpassword') }}"
                                        class="float-right forget-password">{{ __('main.Forget_Password') }}</a>
                                </div>
                                <div class="form-bottom">
                                    <button type="submit" class="primary-btn">{{ __('main.Login') }}</button>
                                    <p class="form-bottom-text">{{ __('main.Don_t_have_an_account__Please') }}? <a
                                            href="{{ route('patient.signup') }}">{{ __('main.Sign_Up') }}</a></p>
                                </div>
                            </form>
                            @if (env('APP_DEMO') == true)
                                <div class='table-responsive login-info-table'>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td id="admin-credential-show" class='login-info'>
                                                    <b>{{ __('Admin:') }}</b> {{ __('admin@gmail.com') }} |
                                                    {{ __('password') }}</td>
                                                <td id="patient-credential-show" class='login-info'>
                                                    <b>{{ __('Patient:') }}</b> {{ __('patient@gmail.com') }} |
                                                    {{ __('password') }}</td>
                                            </tr>
                                            <tr>
                                                <td id="doctor-credential-show" class='login-info'>
                                                    <b>{{ __('Doctor:') }}</b> {{ __('doctor@gmail.com') }} |
                                                    {{ __('password') }}</td>
                                                <td id="stuff-credential-show" class='login-info'>
                                                    <b>{{ __('Staff:') }}</b> {{ __('stuff@gmail.com') }} |
                                                    {{ __('password') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- register area star here  -->
@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
    <script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>
@endpush