@extends('front.layouts.main')
@section('breadcrumb')
    <!-- breadcrumb area start here   -->
    <section class="breadcrumb-area cus-bg-user-img"
        style="background-image: url({{ asset(path_page_banner() . $allsettings['banner']) }})">
        <div class="container">
            <h2 class="page-title">{{ __($page->title) }}</h2>
            <ul class="breadcrumb-page">
                <li><a href="{{ url('/') }}">{{ __('main.Home') }}</a></li>
                <li>{{ $page->translateOrDefault(session()->get('locale'))->label }}</li>
            </ul>
        </div>
    </section>
    <!-- breadcrumb area end here   -->
@endsection
@section('page_title', $page->label)
@section('page_description', str_limit(strip_tags($page->description), 200))
@section('page_tags', $page->tags)
@section('content')
    <!-- page details start here  -->
    <div class="service-details section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="blog-details-area">
                        <h2 class="post-title">{{ $page->translateOrDefault(session()->get('locale'))->label }}</h2>
                        <p class="post-conent">{!! $page->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page details end here  -->
@endsection
