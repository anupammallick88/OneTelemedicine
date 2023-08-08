    <!-- preloader start here  -->
    <div class="preloader">
        <div class="loader">
            <img src="{{ isset($allsettings['preloader']) ? asset(PRELOADER_IMG . $allsettings['preloader']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                alt="{{ __('main.logo') }}" />
        </div>
    </div>
    <!-- preloader end here  -->
    <!-- header area start here  -->
    <header class="header-area">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="topbar-left text-center text-md-left">
                            <ul class="contact-info">
                                <li><a href="#"><i class="flaticon-headphones"></i>
                                        {{ __('main.24_X_7_online_support') }}</a></li>
                                <li><a href="#"><i class="flaticon-phone-call"></i>
                                        {{ $allsettings['helpline_1'] }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="topbar-right text-center text-md-right">
                            <ul class="social-area">
                                @foreach (Theme_socials() as $theme_social)
                                    <li><a target="_blank" href="{{ $theme_social->url }}"><i
                                                class="{{ $theme_social->class }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom" id="sticky">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('front.index') }}"><img
                            src="{{ isset($allsettings['site_logo']) ? asset(path_site_logo_image() . $allsettings['site_logo']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                            alt="{{ __('logo') }}" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            @foreach (header_menu() as $header_menu_item)
                                <li
                                    class="nav-item {{ request()->segment(1) == ltrim($header_menu_item->url, '/') ? 'current-menu-item' : '' }} ">
                                    <a class="nav-link {{ $header_menu_item->css_class }}"
                                        href="{{ url($header_menu_item->url) }}">
                                        {{ $header_menu_item->label }}
                                        @if ($header_menu_item->icon)
                                            <i class="{{ $header_menu_item->icon }}"></i>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                            <li class="dropdown language-dropdown">
                                <button class="dropdown-toggle nav-link" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-expanded="false">
                                    {{ session()->has('locale') ? session()->get('locale') : 'En' }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach (allLanguages() as $lang)
                                        <a class="dropdown-item"
                                            href="{{ route('front.change_language', ['lang' => $lang->prefix]) }}">{{ $lang->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                        @if (Auth::check())
                            <div class="dropdown profile-dropdown-toggle">
                                <a class="profile-btn" href="#" role="button" data-toggle="dropdown">
                                    <img class="profile-image"
                                        src="{{ isset(Auth::user()->image) ? asset(path_user_image() . Auth::user()->image) : Avatar::create(auth()->user()->name)->toBase64() }}"
                                        alt="{{ Auth::user()->name }}" />
                                    <span class="profile-name">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu">
                                    @if (auth()->user()->role != 'admin')
                                        <a class="dropdown-item"
                                            href="{{ redirectDashboard() }}">{{ __('main.Dashboard') }}</a>
                                        <a class="dropdown-item"
                                            href="{{ redirectDashboard('appointments') }}">{{ __('main.Appointments') }}</a>
                                        <a class="dropdown-item"
                                            href="{{ redirectDashboard('profile') }}">{{ __('main.profile') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ url('/logout') }}">{{ __('main.Logout') }}</a>
                                </div>
                            </div>
                        @else
                            <!-- <a class="header-btn" href="{{ route('signin') }}">{{ __('main.Login') }}</a> -->
                            <div class="dropdown">
                                <button class="dropbtn">{{ __('main.Login') }}</button>
                                <div class="dropdown-content">
                                    <a href="{{ route('signin') }}">{{ __('main.Login') }}</a>
                                    <a href="{{ route('patient.signup') }}">{{ __('main.Login_Signup') }}</a>                                    
                                    <a href="{{ route('doctor.signup') }}">{{ __('main.Doctor_Signup') }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- header area end here  -->
