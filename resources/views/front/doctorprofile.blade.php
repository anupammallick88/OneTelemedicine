@extends('front.layouts.main')
@section('page_title', __('main.Doctors'))
@include('front.include.breadcrumb')
@section('content')
    <!-- about doctor start here  -->
    <section class="about-doctor-area section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="doctor-image">
                        <img src="{{ asset(path_user_image() . $doctor->profile_image) }}" alt="{{ __('single-doctor') }}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="doctor-info">
                        <div class="info-top">
                            <h2>{{ $doctor->user->name }}</h2>
                            <div class="info-meta d-flex align-items-center justify-content-between">
                                <span class="catagory">{{ $doctor->category->name }}</span>
                                <span class="fee">{{ __('Fee:') }} ₹{{ $doctor->fees }}</span>
                            </div>
                        </div>
                        <div class="info-bottom">
                            <h3>{{ __('main.About_The_Doctor') }}</h3>
                            <p>{{ $doctor->user->bio }}</p>
                            <a href="{{ route('patient.dashboard.redirect', $doctor->id) }}"
                                class="primary-btn">{{ __('main.Make_Appointment') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about doctor end here  -->
    @include('front.include.testimonial')
    @include('front.include.news')
@endsection
