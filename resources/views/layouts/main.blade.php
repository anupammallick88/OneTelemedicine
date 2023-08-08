<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title', '') | {{ $allsettings['title'] }}</title>
    <!-- initiate head with meta tags, css and script -->
    @include('include.head')
</head>

<body>
    <div id="app" class="wrapper">
        <!-- initiate header-->
        @include('include.header')
        <div class="page-wrap">
            <!-- initiate sidebar-->
            @include('include.sidebar')
            <div class="main-content">
                <!-- yeild contents here -->
                @yield('content')
            </div>
            <!-- initiate footer section-->
            @include('include.footer')
        </div>
    </div>
    <!-- initiate modal menu section-->
    @include('include.modalmenu')
    <!-- initiate scripts-->
    @include('include.script')
</body>

</html>
