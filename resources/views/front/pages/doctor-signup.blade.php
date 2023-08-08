@extends('front.layouts.main')
@section('content')
<!-- breadcrumb area start here   -->
<section class="breadcrumb-area cus-bg-img" style="background-image: url({{ asset(path_page_banner() . $allsettings['banner']) }})">
    <div class="container">
        <h2 class="page-title">{{ __('Sign Up') }}</h2>
        <ul class="breadcrumb-page">
            <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
            <li>{{ __('Sign Up') }}</li>
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
                        <h2 class="form-title">{{ __('SignUp as Doctor') }}</h2>
                        <form method="POST" action="{{ route('doctor.register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="fname" class="col-md-4 col-form-label text-md-left">{{ __('main.First_Name') }}:</label>
                                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}" placeholder="{{ __('First Name') }}" />
                                <!-- <i class="fas fa-user form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('fname')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="lname" class="col-md-4 col-form-label text-md-left">{{ __('main.Last_Name') }}:</label>
                                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}" placeholder="{{ __('Last Name') }}" />
                                <!-- <i class="fas fa-user form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('lname')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('main.Enter_Email') }}:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter Email') }}" />
                                <!-- <i class="fas fa-envelope form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('email')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('main.Password') }}:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Enter Password') }}" />
                                <!-- <i class="fas fa-lock form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('password')) }}</span>
                            </div>
                            <input type="hidden" name="role" value="doctor">
                            <div class="form-group">
                                <label for="gender" class="col-md-4 col-form-label text-md-left">{{ __('main.Gender') }}:</label>
                                <select class="form-control" aria-label="Default select example" id="gender" name="gender" placeholder="{{ __('Enter Gender') }}">
                                    <option selected>--Gender--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                                <!-- <i class="fas fa-male form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('gender')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="birthday" class="col-md-4 col-form-label text-md-left">{{ __('main.BirthDay') }}:</label>
                            <input type="date" name="birthday" id="birthday" class="form-control" placeholder="{{ __('Enter Birthday') }}" />
                                <!-- <i class="fas fa-calendar form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('birthday')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="degree" class="col-md-4 col-form-label text-md-left">{{ __('main.Degree') }}:</label>
                                <input type="text" class="form-control" id="degree" name="degree" placeholder="{{ __('Enter Qualification') }}" />
                                <!-- <i class="fas fa-certificate form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('degree')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="mobile" class="col-md-4 col-form-label text-md-left">{{ __('main.Mobile') }}:</label>
                                <input type="number" class="form-control" id="mobile" name="mobile" placeholder="{{ __('Enter Mobile') }}" />
                                <!-- <i class="fas fa-mobile form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('mobile')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="address" class="col-md-4 col-form-label text-md-left">{{ __('main.Address_') }}:</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="{{ __('Enter Address') }}" />
                                <!-- <i class="fas fa-address-card form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('address')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="city" class="col-md-4 col-form-label text-md-left">{{ __('main.City') }}:</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="{{ __('Enter City') }}" />
                                <!-- <i class="fas fa-city form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('city')) }}</span>
                            </div>
                            <!-- <div class="form-group">
                            <label for="fname" class="col-md-4 col-form-label text-md-left">{{ __('main.Registration_') }}:</label>
                                <input type="text" class="form-control" id="registration" name="registration" placeholder="{{ __('Enter Registration No') }}" />
                                <i class="fas fa-registered form-icon"></i>
                                <span class="text-danger">{{ __($errors->first('registration')) }}</span>
                            </div> -->
                            <div class="form-group">
                            <label for="docat" class="col-md-4 col-form-label text-md-left">{{ __('main.Doctor_Category') }}:</label>
                                <select class="form-control" aria-label="Default select example" id="docat" name="docat" placeholder="{{ __('Enter Specialist') }}">                                    
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }} </option>
                                    @endforeach
                                </select>
                                <!-- <i class="fas fa-user-md form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('docat')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="docat" class="col-md-4 col-form-label text-md-left">{{ __('main.Offday_') }}:</label>
                                <div class="col-md-6">
                                        <input name="off_day[]" value="sat" type="checkbox">
                                        {{ __('main.Saturday') }}
                                        <input name="off_day[]" value="sun" type="checkbox">
                                        {{ __('main.Sunday') }}
                                        <input name="off_day[]" value="mon" type="checkbox">
                                        {{ __('main.Monday') }}
                                        <input name="off_day[]" value="tue" type="checkbox">
                                        {{ __('main.Tuesday') }}
                                        <input name="off_day[]" value="wed" type="checkbox">
                                        {{ __('main.Wednesday') }}
                                        <input name="off_day[]" value="thu" type="checkbox">
                                        {{ __('main.Thursday') }}
                                        <input name="off_day[]" value="fri" type="checkbox">
                                        {{ __('main.Friday') }}
                                        <small class="form-text text-muted">{{ __('main.Check_off_day') }}</small>
                                        <span class="text-danger">{{ __($errors->first('Check_off_day')) }}</span>
                                        <!-- @error('Check_off_day')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                            </span>
                                        @enderror -->
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="fees" class="col-md-4 col-form-label text-md-left">{{ __('main.Fees_') }}:</label>
                                <input type="text" class="form-control" id="fees" name="fees" placeholder="{{ __('Enter Fees') }}" />
                                    <!-- <i class="fas fa-city form-icon"></i> -->
                                    <span class="text-danger">{{ __($errors->first('fees')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="file_one" class="col-md-4 col-form-label text-md-left">{{ __('main.Document One_') }}:</label>
                                <input type="file" class="form-control" id="file_one" name="file_one" placeholder="{{ __('Upload Document') }}" />
                                <!-- <i class="fas fa-file form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('file_one')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="file_two" class="col-md-4 col-form-label text-md-left">{{ __('main.Document Two_') }}:</label>
                                <input type="file" class="form-control" id="file_two" name="file_two" placeholder="{{ __('Upload Document') }}" />
                                <!-- <i class="fas fa-file form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('file_two')) }}</span>
                            </div>
                            <div class="form-group">
                            <label for="file_three" class="col-md-4 col-form-label text-md-left">{{ __('main.Document Three_') }}:</label>
                                <input type="file" class="form-control" id="file_three" name="file_three" placeholder="{{ __('Upload Document') }}" />
                                <!-- <i class="fas fa-file form-icon"></i> -->
                                <span class="text-danger">{{ __($errors->first('file_three')) }}</span>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="agree" value="on" class="form-check-input" id="Agree">
                                <label class="form-check-label" for="Agree">{{ __('I Agree Terms and Conditions.') }}</label>
                                <br>
                                <span class="text-danger">{{ __($errors->first('agree')) }}</span>
                            </div>
                            <div class="form-bottom">
                                <button type="submit" class="primary-btn">{{ __('Sign up Account') }}</button>
                                <p class="form-bottom-text">{{ __('You have a account') }} <a href="{{route('signin')}}">{{ __('Sign In') }}</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- register area star here  -->
<!-- brand area start here  -->
@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
@endpush
