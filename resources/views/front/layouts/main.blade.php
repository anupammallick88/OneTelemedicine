<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('front.include.seo')
    @include('front.include.head')
</head>

<body
    class="{{ session()->has('lang_dir') && session()->get('lang_dir') == 'rtl' ? 'direction-rtl' : 'direction-ltr' }}">
    <div id="app" class="wrapper">
        {{-- message show --}}
        @if (Session::has('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success text-center" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <!-- initiate header-->
        @include('front.include.header')
        <div class="page-wrap">
            <div class="main-content">
                <!-- yeild contents here -->
                @yield('breadcrumb')
                @yield('content')
                @include('front.include.brand')
            </div>
            <!-- initiate footer section-->
            @include('front.include.footer')
        </div>
    </div>
    <!-- initiate scripts-->
    @include('front.include.script')
    @stack('script')
    @yield('scripts')
</body>

</html>
