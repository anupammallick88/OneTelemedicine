@extends('front.layouts.main')
@section('page_title', __('Doctor Dashboard'))
@section('content')
    <!-- breadcrumb area start here   -->
    <section class="breadcrumb-area cus-bg-img"
        style="background-image: url({{ asset(path_page_banner() . $allsettings['banner']) }})">
        <div class="container">
            <h2 class="page-title">
                {{ Auth::user()->role == 'doctor' ? __('Doctor Dashboard') : __('Stuff Dashboard') }}</h2>
            <ul class="breadcrumb-page">
                <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Dashboard') }}</li>
            </ul>
        </div>
    </section>
    <!-- breadcrumb area end here   -->
    <div class="main-section-wrap section doctor-dashboard-area" id="js_variable_data" data-jsvar='{{ $doctorVariables }}'>
        <div class="container">
            <div class="section-header">
                <div class="section-header-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('main.Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user }}" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('main.E-Mail_Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="docat" class="col-md-4 col-form-label text-md-right">{{ __('main.Doctor_Category') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select form-control" name="docat">
                                        @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('docat')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4 col-form-label text-md-right"><label for="text-input" class=" form-control-label">{{ __('main.Off_Day') }}</label></div>
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
                                    @error('Check_off_day')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row row">
                                <div class="col-md-4 col-form-label text-md-right">
                                    <p>{{ __('main.Fees') }}($)</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mr-4">
                                        <input type="number" class="form-control" name="fees" value="10" placeholder="{{ __('main.Fees') }}">
                                        @error('fees')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('main.profile_image') }}</label>
                                <div class="col-md-6">
                                    <input id="putImage" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" value="{{ old('profile_image') }}" autocomplete="profile_image" autofocus>
                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="thumb_image" class="col-md-4 col-form-label text-md-right">{{ __('main.thumb_image') }}</label>
                                <div class="col-md-6">
                                    <input id="putImage1" type="file" class="form-control @error('thumb_image') is-invalid @enderror" name="thumb_image" value="{{ old('thumb_image') }}" autocomplete="thumb_image" autofocus>
                                    @error('thumb_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('main.Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>                        
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    
@endsection
@push('script')
    <script src="{{ asset('front/js/doctor-appointment.js') }}"></script>
@endpush
