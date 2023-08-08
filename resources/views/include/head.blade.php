<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="hello">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ isset($allsettings['favicon']) ? asset(path_site_favicon_image().$allsettings['favicon']) : asset(path_noimage_image().'no-image-200.jpg') }}" />
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="{{ asset('all.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icon-kit/dist/css/iconkit.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/ionicons/dist/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/toaltr/toastr.min.css') }}">
<link rel="stylesheet" href="{{asset('css/toaster.min.css')}}">
<!-- Stack array for including inline css or head elements -->
@stack('head')
<link rel="stylesheet" href="{{asset('css/minimal.css')}}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
