@extends('front.layouts.main')
@section('page_title', __('main.Home'))
@section('content')
    <!-- hero-banner-area start here  -->
    <section class="hero-banner-area">
        <div class="slider-hero-banenr">
            @foreach ($sliders as $slider)
                <div class="single-hero-banenr"
                    style="background-image: url('{{ asset(path_slider_image() . $slider->image) }}');">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hero-area-content">
                                    <h3 class="banner-subtitle"><i class="flaticon-pulse-line"></i>
                                        {{ $slider->translateOrDefault(session()->get('locale'))->small_heading }}</h3>
                                    <h1 class="banner-title">
                                        {{ $slider->translateOrDefault(session()->get('locale'))->big_heading }}</h1>
                                    <p class="banner-text">
                                        {{ $slider->translateOrDefault(session()->get('locale'))->description }}</p>
                                    <a href="{{ route('front.doctor') }}"
                                        class="primary-btn">{{ __('main.Make_Appointment') }}</a>
                                    <a href="{{ url('/contact') }}"
                                        class="primary-btn-outline">{{ __('main.Contact_Us') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($notice != null)
            <div class="alert-area">
                <div class="container">
                    <div class="alert alert-dismissible fade show" role="alert">
                        <div class="alert-left">
                            <div class="media align-items-center alert-text">
                                <div class="icon"><i
                                        class="{{ $notice->translateOrDefault(session()->get('locale'))->icon }}"></i></div>
                                <div class="media-body">
                                    <h4 class="mt-0">{{ $notice->translateOrDefault(session()->get('locale'))->title }}
                                    </h4>
                                    <p class="mb-0">
                                        {{ $notice->translateOrDefault(session()->get('locale'))->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="alert-right">
                            <a href="{{ $notice->button_url }}" target="_blanck"
                                class="primary-btn">{{ $notice->translateOrDefault(session()->get('locale'))->button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <!-- hero-banner-area end here  -->
    @include('front.include.about')
    @include('front.include.counter')
    @include('front.include.service')
    @include('front.include.gallery')
    @include('front.include.doctor')
    @include('front.include.testimonial')
    @include('front.include.news')
@endsection
