<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                <a href="{{ route('front.index') }}" class='ml-2 btn btn-primary'
                    target="_blank">{{ __('main.Visit_Site') }}</a>
            </div>
            <div class="top-menu d-flex align-items-center">
                <div class="btn-group" role="group" aria-label="Button group">
                    <div id="liveClock" class="clock"></div>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img class="avatar"
                            src="{{ isset(Auth::user()->image) ? asset(path_user_image() . Auth::user()->image) : Avatar::create(auth()->user()->name)->toBase64() }}"
                            alt="{{ __('main.Image') }}">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile', auth()->user()->id) }}">
                            <i class="ik ik-circle dropdown-icon"></i>
                            {{ __('main.Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="ik ik-power dropdown-icon"></i>
                            {{ __('main.Logout') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
