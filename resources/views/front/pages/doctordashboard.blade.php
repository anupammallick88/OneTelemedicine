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
                            <div class="tab-menu menu-style-two">
                                <ul class="nav nav-tabs" id="DashboardTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ isset($tab) && $tab == 'dashboard' ? 'active' : '' }}"
                                            id="tabone-tab" data-toggle="tab" href="#tabone" role="tab"
                                            aria-controls="tabone" aria-selected="true">
                                            <i class="fas fa-home"></i> <span>{{ __('Dashboard') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ isset($tab) && $tab == 'today-appointments' ? 'active' : '' }}"
                                            id="tabeight-tab" data-toggle="tab" href="#tabeight" role="tab"
                                            aria-controls="tabtwo" aria-selected="false">
                                            <i class="fas fa-calendar-check"></i> <span>
                                                {{ __('Today Appointments') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ isset($tab) && $tab == 'appointments' ? 'active' : '' }}"
                                            id="tabtwo-tab" data-toggle="tab" href="#tabtwo" role="tab"
                                            aria-controls="tabtwo" aria-selected="false">
                                            <i class="fas fa-calendar-check"></i> <span>
                                                {{ __('All Appointments') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ isset($tab) && $tab == 'profile' ? 'active' : '' }}"
                                            id="tabfour-tab" data-toggle="tab" href="#tabfour" role="tab"
                                            aria-controls="tabfour" aria-selected="false">
                                            <i class="fas fa-user"></i><span>{{ __('profile') }}</span>
                                        </a>
                                    </li>
                                    @if (Auth::check() && Auth::user()->role == 'doctor')
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tabfive-tab" data-toggle="tab" href="#tabfive"
                                                role="tab" aria-controls="tabfive" aria-selected="false">
                                                <i class="fas fa-address-book"></i><span>{{ __('Add Stuff') }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tabseven-tab" data-toggle="tab" href="#tabseven"
                                                role="tab" aria-controls="tabseven" aria-selected="false">
                                                <i class="fas fa-address-book"></i><span>{{ __('Manage Stuff') }}</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::check() && Auth::user()->role == 'stuff')
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tabsix-tab" data-toggle="tab" href="#tabsix"
                                                role="tab" aria-controls="tabsix" aria-selected="false">
                                                <i
                                                    class="fas fa-address-book"></i><span>{{ __('Create Appointment') }}</span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="search-form">
                                <form action="#">
                                    <div class="search-input">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ Session::get('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ __($error) }} <br />
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="section-wraper">
                <div class="tab-content" id="DashboardTabContent">
                    <div class="tab-pane fade {{ isset($tab) && $tab == 'dashboard' ? 'show active' : '' }}"
                        id="tabone" role="tabpanel" aria-labelledby="tabone-tab">
                        <div class="dashboard-box">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-box">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('front/assets/images/box-image-4.png') }}"
                                                class="box-image mr-4" alt="{{ __('box image') }}" />
                                            <div class="media-body">
                                                <h4 class="counter-title mt-0">{{ __('Total Patient') }}</h4>
                                                <h2 class="counter">{{ $totalpatient }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-box">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('front/assets/images/box-image-13.png') }}"
                                                class="box-image mr-4" alt="{{ __('box image') }}" />
                                            <div class="media-body">
                                                <h4 class="counter-title mt-0">{{ __('Pending Patient') }}</h4>
                                                <h2 class="counter color-three">{{ $pendingAppointment }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-box">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('front/assets/images/box-image-7.png') }}"
                                                class="box-image mr-4" alt="{{ __('box image') }}" />
                                            <div class="media-body">
                                                <h4 class="counter-title mt-0">{{ __('Total Earnings') }}</h4>
                                                @if (auth()->user()->role == 'doctor')
                                                    <h2 class="counter color-four">
                                                        {{ fetchOnlineEarningByDoctor(auth()->user()->doctor->id) }}
                                                    </h2>
                                                @else
                                                    <h2 class="counter color-four">
                                                        {{ fetchOnlineEarningByDoctor($doctor->doctor->id) }}</h2>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-box">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('front/assets/images/box-image-12.png') }}"
                                                class="box-image mr-4" alt="{{ __('box image') }}" />
                                            <div class="media-body">
                                                <h4 class="counter-title mt-0">{{ __('Patient') }}
                                                    ({{ now()->format('F') }})</h4>
                                                <h2 class="counter">{{ $totalpatientmonth }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-box">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('front/assets/images/box-image-11.png') }}"
                                                class="box-image mr-4" alt="{{ __('box image') }}" />
                                            <div class="media-body">
                                                <h4 class="counter-title mt-0">{{ __('Earnings') }}
                                                    ({{ now()->format('F') }})</h4>
                                                @if (auth()->user()->role == 'doctor')
                                                    <h2 class="counter color-four">{{ $totalearningmonth }}</h2>
                                                @else
                                                    <h2 class="counter color-four">{{ $totalearningmonth }}</h2>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3 col-md-6">
                                    <div class="single-box">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('front/assets/images/box-image-10.png') }}"
                                                class="box-image mr-4" alt="{{ __('box image') }}" />
                                            <div class="media-body">
                                                <h4 class="counter-title mt-0">{{ __('Online') }}
                                                    ({{ now()->format('F') }})</h4>
                                                @if (auth()->user()->role == 'doctor')
                                                    <h2 class="counter color-four">{{ $total_online_earning_month }}
                                                    </h2>
                                                @else
                                                    <h2 class="counter color-four">{{ $total_online_earning_month }}
                                                    </h2>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-box">
                                        <div class="media align-items-center">
                                            <img src="{{ asset('front/assets/images/box-image-9.png') }}"
                                                class="box-image mr-4" alt="{{ __('box image') }}" />
                                            <div class="media-body">
                                                <h4 class="counter-title mt-0">{{ __('Total Pay Out') }} </h4>
                                                <h2 class="counter color-four">
                                                    @if (auth()->user()->role == 'doctor')
                                                        {{ admintopay(auth()->user()->doctor->id) }}
                                                    @else
                                                        {{ admintopay($doctor->doctor->id) }}
                                                    @endif
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <a href="{{ route('doctor.financialReport') }}">
                                        <div class="single-box report-box">
                                            <div class="media align-items-center">
                                                <img src="{{ asset('front/assets/images/box-image-8.png') }}"
                                                    class="box-image mr-4" alt="{{ __('box image') }}" />
                                                <div class="media-body">
                                                    <h4 class="counter-title mt-0">{{ __('Financial Report') }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="section-heading-area section-heading-area-dashboard">
                            <h2 class="section-title">{{ __('Appointment Requests') }}</h2>
                        </div>
                        <div class="primary-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('Patient Name') }}</th>
                                            <th scope="col">{{ __('Date') }}</th>
                                            <th scope="col">{{ __('Time') }}</th>
                                            <th scope="col">{{ __('Type') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dashboardpagi" class="accordion">
                                        @include('front.pages.doctordashboardpagi')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ isset($tab) && $tab == 'appointments' ? 'show active' : '' }}"
                        id="tabtwo" role="tabpanel" aria-labelledby="tabtwo-tab">
                        <div class="section-inner-header section-heading-area">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h2 class="section-title">{{ __('All Appointment') }}</h2>
                                </div>
                                <div class="col-lg-6">
                                    <div class="inner-header-right">
                                        <div class="appoinment-search">
                                            <form action="#">
                                                <div class="input-wrap">
                                                    <div class="search-input">
                                                        <input type="text" class="form-control"
                                                            name="appoinmentsearch" id="appoinmentsearch"
                                                            placeholder="{{ __('Search Your Appointment') }}" />
                                                        <button class="search-btn"><i class="fas fa-search"></i></button>
                                                    </div>
                                                    <div class="date-input">
                                                        <input type="text" class="form-control" name="appoinmentdate"
                                                            id="appoinmentdate" placeholder="{{ __('Search Date') }}" />
                                                        <span class="form-icon"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="AppominmentTabContent">
                            <div class="tab-pane fade" id="TodayAppominment" role="tabpanel"
                                aria-labelledby="TodayAppominment-tab">
                                @include('front.pages.doctor_today_pagination')
                                <div class="primary-table d-none" id="searchheadtoday">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('Patient Name') }}</th>
                                                    <th scope="col">{{ __('Date') }}</th>
                                                    <th scope="col">{{ __('Time') }}</th>
                                                    <th scope="col">{{ __('Type') }}</th>
                                                    <th scope="col">{{ __('Status') }}</th>
                                                    <th scope="col">{{ __('Prescription') }}</th>
                                                    <th scope="col">{{ __('Test Reports') }}</th>
                                                    @if (Auth::user()->role == 'doctor')
                                                        <th scope="col">{{ __('Meeting') }}</th>
                                                    @endif
                                                    <th scope="col">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="searchbodytoday">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="PastAppominment" role="tabpanel"
                                aria-labelledby="PastAppominment-tab">
                                @include('front.pages.doctor_past_pagination')
                                <!-- searchtable start -->
                                <div class="primary-table d-none" id="searchhead">
                                    <div class="table-responsive">
                                        <table class="table" id="todaypagination">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('Patient Name') }}</th>
                                                    <th scope="col">{{ __('Date') }}</th>
                                                    <th scope="col">{{ __('Time') }}</th>
                                                    <th scope="col">{{ __('Type') }}</th>
                                                    <th scope="col">{{ __('Status') }}</th>
                                                    <th scope="col">{{ __('Prescription') }}</th>
                                                    <th scope="col">{{ __('Test Reports') }}</th>
                                                    @if (Auth::user()->role == 'doctor')
                                                        <th scope="col">{{ __('Meeting') }}</th>
                                                    @endif
                                                    <th scope="col">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="searchbody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- searchtable end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ isset($tab) && $tab == 'profile' ? 'show active' : '' }}" id="tabfour"
                        role="tabpanel" aria-labelledby="tabfour-tab">
                        <div class="section-heading-area">
                            <h2 class="section-title">{{ __('Profile') }}</h2>
                        </div>
                        <div class="profile-area">
                            <div class="profile-bottom">
                                <div class="row">
                                    <div class="col-xl-10 offset-xl-1">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4">
                                                <div class="profile-top">
                                                    <div class="profile-thumbnail">
                                                        <img src="{{ isset(Auth::user()->image) ? asset(path_user_image() . Auth::user()->image) : Avatar::create(Auth::user()->name)->toBase64() }}"
                                                            class="profile-image mr-3" alt="{{ __('profile') }}" />
                                                    </div>
                                                    <div class="profile-info">
                                                        <h3 class="user-name mt-0">{{ Auth::user()->name }}</h3>
                                                        <h4 class="user-age">{{ __('Age:') }}
                                                            {{ Auth::user()->age }} {{ __('Years') }}</h4>
                                                        <button class="profile-btn" type="button" data-toggle="modal"
                                                            data-target="#editeprofilemodal"><i class="far fa-edit"></i>
                                                            {{ __('Edit Info') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                <div class="profile-left">
                                                    <div class="secondary-form">
                                                        <form>
                                                            <h3 class="form-title">
                                                                {{ __('Basic Information') }}</h3>
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Email') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ Auth::user()->email }}"
                                                                            readonly />
                                                                        <span
                                                                            class="text-danger">{{ __($errors->first('email')) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Gender') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ Auth::user()->gender }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('BirthDay') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ date('d M Y', strtotime(Auth::user()->dob)) }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Degree') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ Auth::user()->qualification }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Mobile') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ Auth::user()->mobile }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h3 class="form-title mt-20">
                                                                {{ __('Address Information') }}</h3>
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Street Address') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ Auth::user()->address }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('City') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ Auth::user()->city }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Zip Code') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="{{ Auth::user()->code }}"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabfive" role="tabpanel" aria-labelledby="tabfive-tab">
                        <div class="add-stuff-area">
                            <div class="add-stuff-bottom">
                                <div class="row">
                                    <div class="col-xl-10 offset-xl-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="section-heading-area">
                                                    <h2 class="section-title">{{ __('Add Stuff') }}</h2>
                                                </div>

                                                <form method="POST" action="{{ route('stuff.add') }}">
                                                    @csrf
                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group">
                                                                    <i class="far fa-user"></i>
                                                                    <input type="text" name="fname"
                                                                        class="form-control"
                                                                        placeholder="{{ __('First name') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group">
                                                                    <i class="far fa-user"></i>
                                                                    <input type="text" name="lname"
                                                                        class="form-control"
                                                                        placeholder="{{ __('Last name') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="input-group">
                                                                    <i class="far fa-envelope"></i>
                                                                    <input type="email" name="email"
                                                                        class="form-control"
                                                                        placeholder="{{ __('Email') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group mb-0 position-relative">
                                                                    <i class="fas fa-lock"></i>
                                                                    <input class="form-control" name="password"
                                                                        id="passInput"
                                                                        placeholder="{{ __('Password') }}"
                                                                        type="password">
                                                                    <i class="fas fa-eye" id="showPass"></i>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group mb-0 position-relative">
                                                                    <i class="fas fa-lock"></i>
                                                                    <input class="form-control" name="confirm_password"
                                                                        id="passConfirmInput"
                                                                        placeholder="{{ __('Confirm Password') }}d"
                                                                        type="password">
                                                                    <i class="fas fa-eye" id="showConfirmPass"></i>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <div class="form-group mb-0">
                                                                <div class="form-check generate-default-password">
                                                                    <input class="form-check-input default-pass"
                                                                        type="checkbox" id="gridCheck">
                                                                    <label class="form-check-label" for="gridCheck">
                                                                        {{ __('check_field_default_pass') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __('Save Stuff') }}</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabsix" role="tabpanel" aria-labelledby="tabsix-tab">
                        <div class="add-stuff-area">
                            <div class="add-stuff-bottom">
                                <div class="row">
                                    <div class="col-xl-10 offset-xl-1">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="section-heading-area">
                                                    <h2 class="section-title">{{ __('Create Appointment') }}</h2>
                                                </div>

                                                <form action="{{ route('stuff.create_appointment') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="doctor_id"
                                                        value="{{ auth()->user()->role == 'stuff' ? $doctor->doctor->id : '' }}">
                                                    <input type="hidden" name="doctorsService"
                                                        value="{{ auth()->user()->role == 'stuff' ? $doctor->doctor->specialist : '' }}">
                                                    <input type="hidden" name="fees"
                                                        value="{{ auth()->user()->role == 'stuff' ? $doctor->doctor->fees : '' }}">
                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group">
                                                                    <i class="far fa-user"></i>
                                                                    <input type="text" class="form-control"
                                                                        name="fname"
                                                                        placeholder="{{ __('First name') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group">
                                                                    <i class="far fa-user"></i>
                                                                    <input type="text" class="form-control"
                                                                        name="lname"
                                                                        placeholder="{{ __('Last name') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="input-group">
                                                                    <i class="far fa-envelope"></i>
                                                                    <input type="email" class="form-control"
                                                                        name="email"
                                                                        placeholder="{{ __('Email') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group">
                                                                    <i class="fas fa-calendar"></i>
                                                                    <input type="date" name="app_date"
                                                                        class="form-control"
                                                                        placeholder="{{ __('Date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="input-group">
                                                                    <i class="fas fa-business-time"></i>
                                                                    <select name="slot_id" class="form-control">
                                                                        @foreach ($docslots as $docslot)
                                                                            <option value="{{ $docslot->id }}">
                                                                                {{ Carbon\Carbon::parse($docslot->start_time)->format('h:i A') }}-{{ Carbon\Carbon::parse($docslot->end_time)->format('h:i A') }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class=" mb-0 position-relative">
                                                                    <textarea name="comment" class="stuff-create-appointment-" cols="30" rows="10"
                                                                        placeholder="{{ __('Write something') }}"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __('Create Appointment') }}</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabseven" role="tabpanel" aria-labelledby="tabseven-tab">
                        <div class="section-heading-area">
                            <h2 class="section-title">{{ __('Manage Stuff') }}</h2>
                        </div>
                        <div class="primary-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('Name') }}</th>
                                            <th scope="col">{{ __('Email') }}</th>
                                            <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($stuffs as $stuff)
                                            <tr>
                                                <td>{{ $stuff->name }}</td>
                                                <td>{{ $stuff->email }}</td>
                                                <td>
                                                    <ul class="action-area">
                                                        <li><a class="delet-btn action-btn"
                                                                href="{{ route('stuff.delete', $stuff->id) }}"><i
                                                                    class="fas fa-trash-alt"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    No stuff found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ isset($tab) && $tab == 'today-appointment' ? 'show active' : '' }}"
                        id="tabeight" role="tabpanel" aria-labelledby="tabeight-tab">
                        <div class="section-heading-area">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="section-title">{{ __('Today Appointments') }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                @include('front.pages.doctor_today_pagination')
                                <div class="primary-table d-none" id="searchheadtoday">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('Patient Name') }}</th>
                                                    <th scope="col">{{ __('Date') }}</th>
                                                    <th scope="col">{{ __('Time') }}</th>
                                                    <th scope="col">{{ __('Type') }}</th>
                                                    <th scope="col">{{ __('Status') }}</th>
                                                    <th scope="col">{{ __('Test Reports') }}</th>
                                                    <th scope="col">{{ __('Prescription') }}</th>
                                                    @if (Auth::user()->role == 'doctor')
                                                        <th scope="col">{{ __('Meeting') }}</th>
                                                    @endif
                                                    
                                                    <th scope="col">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="searchbodytoday">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editeprofilemodal">
        <div class="modal-dialog modal-dialog-centered editeprofilemodal">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="section-heading-area">
                        <h2 class="section-title">{{ __('Edit Profile') }}</h2>
                    </div>
                    <div class="edite-profile-area">
                        <div class="primary-form">
                            <form action="{{ route('user.profile', auth()->user()->id) }}" method="POST"
                                id="editform" enctype="multipart/form-data">
                                @csrf
                                <div class="profile-image-area">
                                    <div class="profile-image">
                                        <span id="openfile">
                                            <img id="target" class="cus-doctor-img-edit"
                                                src="{{ isset(Auth::user()->image) ? asset(path_user_image() . Auth::user()->image) : Avatar::create(Auth::user()->name)->toBase64() }}">
                                        </span>
                                    </div>
                                    <div class="custom-fileuplode">
                                        <input type="file" id="file-input" name="image" class="form-control-file">
                                    </div>
                                </div>
                                <h4 class="form-inner-title">{{ __('Birthday') }}</h4>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ Auth::user()->name }}"
                                                placeholder="{{ isset(Auth::user()->name) ? Auth::user()->name : __('Enter your name') }}"
                                                required />
                                            <small
                                                class="text-danger d-none nameerror">{{ __('Name field is required') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="{{ Auth::user()->email }}"
                                                placeholder="{{ isset(Auth::user()->email) ? Auth::user()->email : __('Enter your email') }}" />
                                            <small
                                                class=" text-danger d-none emailerror">{{ __('Email field is required') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dob">{{ __('Date of Birth') }}</label>
                                            <input type="date" class="form-control" name="dob" id="dob"
                                                value="{{ date('Y-m-d', strtotime(Auth::user()->dob)) }}"
                                                placeholder="{{ isset(Auth::user()->dob) ? Auth::user()->dob : __('Enter your date of birth') }}" />
                                            <small
                                                class=" text-danger d-none dateerror">{{ __('Date field is required') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="age">{{ __('Age') }}</label>
                                            <input type="text" class="form-control" name="age" id="age"
                                                value="{{ Auth::user()->age }}"
                                                placeholder="{{ isset(Auth::user()->age) ? Auth::user()->age : __('Enter your age') }}" />
                                            <small
                                                class=" text-danger d-none ageerror">{{ __('Age field is required') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="gender-group">
                                            <span>{{ __('Gender:') }}</span>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="male" value="male"
                                                    @if (isset(Auth::user()->gender)) @if (Auth::user()->gender == 'male')
                                            checked @endif
                                                    @endif
                                                >
                                                <label class="form-check-label" for="male">
                                                    {{ __('Male') }}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="famale" value="female"
                                                    @if (isset(Auth::user()->gender)) @if (Auth::user()->gender == 'female')
                                            checked @endif
                                                    @endif>
                                                <label class="form-check-label" for="famale">
                                                    {{ __('Female') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="form-inner-title">{{ __('Address Information') }}</h4>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">{{ __('Address') }}</label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                value="{{ Auth::user()->address }}"
                                                placeholder="{{ isset(Auth::user()->address) ? Auth::user()->address : __('Enter your address') }} " />
                                            <small
                                                class=" text-danger d-none addresserror">{{ __('Address field is required') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city">{{ __('City') }}</label>
                                            <input type="text" class="form-control" name="city" id="city"
                                                value="{{ Auth::user()->city }}"
                                                placeholder="{{ isset(Auth::user()->city) ? Auth::user()->city : __('Enter your city') }} " />
                                            <small
                                                class=" text-danger d-none cityerror">{{ __('City field is required') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="code">{{ __('Code') }}</label>
                                            <input type="text" class="form-control" name="code" id="code"
                                                value="{{ Auth::user()->code }}"
                                                placeholder="{{ isset(Auth::user()->code) ? Auth::user()->code : __('Enter your code') }}" />
                                            <small
                                                class=" text-danger d-none codeerror">{{ __('Code field is required') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h4 class="form-inner-title">{{ __('About Yourself') }}</h4>
                                            <textarea class="form-control" name="bio" id="bio" cols="30" rows="10">{{ isset(Auth::user()->bio) ? Auth::user()->bio : '' }}</textarea>
                                            <small
                                                class=" text-danger d-none bioerror">{{ __('About field is required') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <button class="primary-btn changesave" type="submit">{{ __('Changes Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal -->
    <!-- MakePrescription  Modal --> 
    @foreach ($todaysapp as $app)
        <div class="modal fade" id="MakePrescription{{ $app->id }}">
            <div class="modal-dialog modal-dialog-centered prescriptionmodal">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <div class="prescription-wrap">
                            <div class="prescription-top">
                                <h2 class="section-title">{{ __('All Appointment') }}
                                    <span>{{ __('Make Prescription') }}</span>
                                </h2>
                                <div class="edit-prescription-area">
                                    <div class="edit-prescription-form">
                                        <form action="{{ route('prescription', $app->id) }}" method="POST">
                                            @csrf
                                            <div class="prescription-header">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="patient-info d-flex flex-wrap flex-row">
                                                            <div class="sigle-info">
                                                                <span>{{ __('Patient Name') }}</span>
                                                                <h4>{{ $app->patient->name }}</h4>
                                                            </div>
                                                            <div class="sigle-info">
                                                                <span>{{ __('Patient ID') }}</span>
                                                                <h4>#{{ $app->patient->id }}</h4>
                                                            </div>
                                                            <div class="sigle-info">
                                                                <span>{{ __('Gender') }}</span>
                                                                <h4>{{ $app->patient->gender }}</h4>
                                                            </div>
                                                            <div class="sigle-info">
                                                                <span>{{ __('Age') }}</span>
                                                                <h4>{{ $app->patient->age }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-top mb-30">
                                                    <div class="row">
                                                        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <label>{{ __('Patient Type') }}</label>
                                                                <select class="form-control">
                                                                    <option>{{ __('Returning') }}</option>
                                                                    <option>{{ __('new') }}</option>
                                                                </select>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <label>{{ __('Patient Weight') }}</label>
                                                                <select name="patient_weight" class="form-control">
                                                                    <option value="10">{{ __('10') }}</option>
                                                                    <option value="15">{{ __('15') }}</option>
                                                                    <option value="20">{{ __('20') }}</option>
                                                                    <option value="25">{{ __('25') }}</option>
                                                                    <option value="30">{{ __('30') }}</option>
                                                                    <option value="35">{{ __('35') }}</option>
                                                                    <option value="40">{{ __('40') }}</option>
                                                                    <option value="45">{{ __('45') }}</option>
                                                                    <option value="50">{{ __('50') }}</option>
                                                                    <option value="55">{{ __('55') }}</option>
                                                                    <option value="60">{{ __('60') }}</option>
                                                                    <option value="65">{{ __('65') }}</option>
                                                                    <option value="70">{{ __('70') }}</option>
                                                                    <option value="75">{{ __('75') }}</option>
                                                                    <option value="80">{{ __('80') }}</option>
                                                                    <option value="85">{{ __('85') }}</option>
                                                                    <option value="90">{{ __('90') }}</option>
                                                                    <option value="95">{{ __('95') }}</option>
                                                                    <option value="100">{{ __('100') }}</option>
                                                                    <option value="105">{{ __('105') }}</option>
                                                                    <option value="110">{{ __('110') }}</option>
                                                                    <option value="115">{{ __('115') }}</option>
                                                                    <option value="120">{{ __('120') }}</option>
                                                                    <option value="125">{{ __('125') }}</option>
                                                                    <option value="130">{{ __('130') }}</option>
                                                                    <option value="135">{{ __('135') }}</option>
                                                                    <option value="140">{{ __('140') }}</option>
                                                                    <option value="145">{{ __('145') }}</option>
                                                                    <option value="150">{{ __('150') }}</option>
                                                                </select>
                                                                <span class="weight-label">{{ __('kg') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="PatientBP">{{ __('Patient BP') }}</label>
                                                                <input type="number" class="form-control" id="PatientBP"
                                                                    name="PatientBP"
                                                                    placeholder="{{ __('BP') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="PatientTemperature">{{ __('Patient Temperature') }}</label>
                                                                <input type="number" class="form-control"
                                                                    id="PatientTemperature" name="PatientTemperature"
                                                                    placeholder="{{ __('Temperature') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <label for="patient_age">{{ __('Age') }}</label>
                                                                <input type="number" class="form-control"
                                                                    id="patient_age" name="patient_age"
                                                                    placeholder="{{ __('Age') }}" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="prescription-body">
                                                <div class="medicine-area mb-40">
                                                    <div class="primary-table-three">
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless" id="medicine_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">
                                                                            {{ __('Medicine Name') }}
                                                                        </th>
                                                                        <th scope="col">{{ __('Type') }}</th>
                                                                        <th scope="col">{{ __('Mg/Ml') }}</th>
                                                                        <th scope="col">{{ __('Dose') }}</th>
                                                                        <th scope="col">{{ __('Day') }}</th>
                                                                        <th scope="col" colspan="2">
                                                                            {{ __('Comment') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="medicine">
                                                                    @if ($errors->any())
                                                                        <div id="error-box">
                                                                            <p class="text-danger">
                                                                                {{ __('Please fill up all the field') }}
                                                                            </p>
                                                                        </div>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <a class="add-btn" id="add-tablebtn" href="javascript:void(0)"><i
                                                            class="fas fa-plus"></i>{{ __('Add') }}</a>
                                                </div>
                                                <div class="test-area mb-40">
                                                    <div class="primary-table-three">
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">{{ __('Test') }}</th>
                                                                        <th scope="col" colspan="2">
                                                                            {{ __('Comment') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="testtable">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <a class="add-btn" id="add-testbtn" href="javascript:void(0)"><i
                                                            class="fas fa-plus"></i> {{ __('Add') }}</a>
                                                </div>
                                                <div class="advice-area mt-3 mb-40">
                                                    <div class="form-group">
                                                        <label for="advice">{{ __('Advice') }}</label>
                                                        <input type="text" class="form-control" id="advice"
                                                            name="advice" placeholder="{{ __('Advice') }}" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="prescription-footer text-right">
                                                <button id="presBtnSubmit"
                                                    class="primary-btn mr-2">{{ __('Confirm') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- MakePrescription  Modal -->
    <!-- ViewPrescription  Modal -->
    @foreach ($pastappModal as $vapp)
        <div class="modal fade" id="ViewPrescription{{ $vapp->id }}">
            <div class="modal-dialog modal-dialog-centered prescriptionmodal">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <div class="prescription-wrap">
                            <div class="prescription-top mb-30">
                                <h2 class="section-title">{{ __('All Appointment') }} <span>/
                                        {{ __('View Prescription') }}</span></h2>
                            </div>
                            <div class="prescription-area">
                                <div id="printable">
                                    <div class="prescription-header mb-30">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="prescription-header-left">
                                                    <h3>{{ isset($vapp->doctor->user->name) ? $vapp->doctor->user->name : '' }}
                                                    </h3>
                                                    <span>{{ isset($vapp->doctor->specialist) ? $vapp->doctor->specialist : '' }}</span>
                                                    <h4>{{ $vapp->doctorsService }}</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="prescription-header-center">
                                                    <p>{{ $vapp->degree }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="prescription-header-right">
                                                    <div class="prescription-timing mb-2">
                                                        <h4>{{ __('Offday-') }}
                                                            {{ isset($vapp->doctor->offday) ? $vapp->doctor->offday : '' }}day
                                                        </h4>
                                                        @if (isset($vapp->doctor->starttime) && isset($vapp->doctor->endtime))
                                                            <span>{{ Carbon\Carbon::parse($vapp->doctor->starttime)->format('h:i A') }}-{{ Carbon\Carbon::parse($vapp->doctor->endtime)->format('h:i A') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="prescription-timing">
                                                        @if (isset($vapp->doctor->starttime2) && isset($vapp->doctor->endtime2))
                                                            <span>{{ Carbon\Carbon::parse($vapp->doctor->starttime2)->format('h:i A') }}-{{ Carbon\Carbon::parse($vapp->doctor->endtime2)->format('h:i A') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="prescription-date mb-30">
                                        <p>{{ __('Appointment Date:') }}
                                            {{ Carbon\Carbon::parse($vapp->adddate)->format('d M, Y, D') }} ,
                                            {{ $vapp->slot ? Carbon\Carbon::parse($vapp->slot->start_time ?? '')->format('H:i A') : 'N/A' }}-{{ Carbon\Carbon::parse($vapp->slot->end_time ?? '')->format('H:i A') }}
                                        </p>
                                    </div>
                                    <div class="prescription-body ">
                                        <div class="prescription-info mb-30">
                                            <h3 class="prescription-section-title mb-3">{{ __('Medicine:') }}</h3>
                                            <div class="primary-table">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('Medicine Name') }}</th>
                                                                <th scope="col">{{ __('Type') }}</th>
                                                                <th scope="col">{{ __('Mg/Ml') }}</th>
                                                                <th scope="col">{{ __('Dose') }}</th>
                                                                <th scope="col">{{ __('Day') }}</th>
                                                                <th scope="col">{{ __('Comments') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($vapp->prescription as $key => $prescription)
                                                                @if (is_array(json_decode($prescription->medicine_name, true)))
                                                                    @php
                                                                        $type = json_decode($prescription->medicine_type, true);
                                                                        $quantity = json_decode($prescription->medicine_quantity, true);
                                                                        $dose = json_decode($prescription->medicine_dose, true);
                                                                        $day = json_decode($prescription->medicine_day, true);
                                                                        $comment = json_decode($prescription->medicine_comment, true);
                                                                    @endphp
                                                                    @foreach (json_decode($prescription->medicine_name, true) as $key1 => $medicine)
                                                                        <tr>
                                                                            <td>{{ $medicine }}</td>
                                                                            <td>{{ $type[$key1] }}</td>
                                                                            <td>{{ $quantity[$key1] }}</td>
                                                                            <td>{{ $dose[$key1] }}</td>
                                                                            <td>{{ $day[$key1] }}</td>
                                                                            <td>{{ $comment[$key1] }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mx-0">
                                            <div class="col-lg-4 ">
                                                <div class="patient-info mb-30">
                                                    <h3 class="prescription-section-title mb-2">
                                                        {{ __('Patient Info:') }}</h3>
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ __('Name') }} </td>
                                                                <td>: <b>{{ $vapp->patient->name }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ __('Age') }} </td>
                                                                <td>: <b>{{ $vapp->patient->age }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ __('Gender') }} </td>
                                                                <td>: <b>{{ $vapp->patient->gender }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ __('Blood Pressure') }} </td>
                                                                <td>:
                                                                    <b>{{ isset($vapp->prescription()->latest()->first()->patient_bp)? $vapp->prescription()->latest()->first()->patient_bp: '' }}</b>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                @if ($vapp->testprescription)
                                                    <div class="test-repot mb-30">
                                                        <h3 class="prescription-section-title mb-3">
                                                            {{ __('Test') }}
                                                        </h3>
                                                        <ul>
                                                            @foreach ($vapp->testprescription as $test)
                                                                <li><span>{{ $test->test_name }}</span></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if ($vapp->prescription)
                                                    <div class="advice-list-area mb-30">
                                                        <h3 class="prescription-section-title mb-3">
                                                            {{ __('Advice') }}
                                                        </h3>
                                                        <ul>
                                                            @foreach ($vapp->prescription as $comment)
                                                                <li><span>{{ $comment->advice }}</span></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="prescription-footer text-right">
                                    <a class="primary-btn mr-2"
                                        href="{{ route('pdfdownload', $vapp) }}">{{ __('Download') }} </a>
                                    <a class="primary-btn" href="{{ route('printpres', $vapp) }}"
                                        target="_blank">{{ __('Print') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ViewPrescription  Modal -->
    @endforeach

    

    @foreach ($appointment as $ap)
        <div class="modal fade common-modal create-meeting-modal" id="cancelAppointmentModal{{ $ap->id }}"
            tabindex="-1" role="dialog" aria-labelledby="cancelAppointmentModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Cancel Appointment') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('cancel.appointment', $ap->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="reason">{{ __('Reason') }}</label>
                                <textarea class="form-control create-meeting-info" id="reason" rows="3" name="reason"
                                    placeholder="{{ __('Write something') }}" required></textarea>
                            </div>
                            <button type="submit"
                                class="btn btn-primary create-meeting-info-button">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade common-modal create-meeting-modal" id="createMeetingModal{{ $ap->id }}"
            tabindex="-1" role="dialog" aria-labelledby="createMeetingModalTitle{{ $ap->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Create Meeting') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('doctor.zoom_create_link') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden"
                                value="{{ __('Meeting with ' . Auth::user()->name . ' and ' . $ap->patient->name) }}"
                                name="topic">
                            <input type="hidden" value="{{ \Carbon\Carbon::now() }}" name="start_time">
                            <input type="hidden" value="30" name="duration">
                            <input type="hidden" value="1" name="host_video">
                            <input type="hidden" value="1" name="participant_video">
                            <input type="hidden" value="{{ $ap->id }}" name="appointment_id">
                            <input type="hidden" value="{{ $ap->doctor_id }}" name="doctor_id">
                            <input type="hidden" value="{{ $ap->user_id }}" name="user_id">
                            <div class="create-meeting-info"><span>{{ __('Patient:') }}</span>
                                {{ $ap->patient->name }}</div>
                            <div class="create-meeting-info"><span>{{ __('Appointment Date:') }}</span>
                                {{ $ap->appdate }}</div>
                            <div class="create-meeting-info"><span>{{ __('Appointment Time:') }}</span>
                                {{ $ap->slot ? \Carbon\Carbon::parse($ap->slot->start_time)->format('g:i a') : 'N/A' }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Create Meeting') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        @if (hasMeeting($ap->id) == 1)
            <div class="modal fade common-modal create-meeting-modal" id="viewMeetingModal{{ $ap->id }}"
                tabindex="-1" role="dialog" aria-labelledby="viewMeetingModalTitle{{ $ap->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $ap->meeting->topic }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="create-meeting-info"><span>{{ __('Join URL:') }}</span>
                                {{ $ap->meeting->join_url }} <a href="{{ $ap->meeting->join_url }}"
                                    class="btn btn-primary" target="_blank">{{ __('Click Link') }}</a></div>
                            <div class="create-meeting-info"><span>{{ __('Meeting ID:') }}</span>
                                {{ $ap->meeting->meeting_id }}</div>
                            <div class="create-meeting-info"><span>{{ __('Meeting Password:') }}</span>
                                {{ $ap->meeting->password }}</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Modal -->
    {{-- <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div> --}}
@endsection
@push('script')
    <script src="{{ asset('front/js/doctor-appointment.js') }}"></script>
@endpush
