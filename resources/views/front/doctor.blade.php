@extends('front.layouts.main')
@section('page_title', __('main.Doctors'))
@include('front.include.breadcrumb')
@section('content')
    <!-- team area start here  -->
    <section class="team-area section-top pb-90">
        <div class="container">
            <div class="section-title text-center">
                <div class="row">
                    @if (section_title('doctor-section') != null)
                        <div class="col-lg-12">
                            <h2 class="title">
                                {{ section_title('doctor-section')->translateOrDefault(session()->get('locale'))->title }}
                            </h2>
                            <p class="subtitle">
                                {{ section_title('doctor-section')->translateOrDefault(session()->get('locale'))->description }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="secondary-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($doctor_category as $category)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tabone{{ $category->id }}-tab"
                                data-toggle="tab" href="#tabone{{ $category->id }}" role="tab"
                                aria-controls="tabone{{ $category->id }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="myTabContent">
                    @foreach ($doctor_category as $category)
                        <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="tabone{{ $category->id }}"
                            role="tabpanel" aria-labelledby="tabone{{ $category->id }}-tab">
                            <div class="team-list">
                                <div class="row">
                                    @foreach ($category->doctor as $doctor)
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="single-team">                                                
                                                    <div class="team-thumbnail">
                                                        <img src="{{ isset($doctor->user->image) ? asset(path_user_image() . $doctor->user->image) : asset(path_noimage_image() . 'no-image-50.png') }}"
                                                            alt="{{ $doctor->user->name }}" />
                                                        <div class="team-overlay">
                                                            <div class="overlay-wrap text-center">
                                                                <a href="{{ route('front.doctorprofile', $doctor->id) }}"
                                                                    class="secondary-btn btn mb-3">{{ __('view profile') }}</a>
                                                                <a href="{{ route('patient.dashboard.redirect', $doctor->id) }}"
                                                                    class="primary-btn btn">{{ __('Make appointment') }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="team-info">
                                                        <h4 class="team-name">{{ $doctor->user->name }}</h4>
                                                        <ul>
                                                            <li class="catagory">{{ $category->name }}</li>
                                                            <li class="price">{{ __('Fee:') }} ₹{{ $doctor->fees }}</li>
                                                        </ul>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- team area end here  -->
    @include('front.include.testimonial')
    @include('front.include.news')
@endsection
