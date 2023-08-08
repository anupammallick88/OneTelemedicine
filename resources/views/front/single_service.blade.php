@extends('front.layouts.main')
@include('front.include.breadcrumb')
@section('page_title', $service->title)
@section('page_description', $service->description)
@section('page_tags', $service->tags)
@section('content')
    <!-- service details start here  -->
    <div class="service-details section-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <aside class="sidebar-widget ">
                        <div class="single-widget catagory-widget">
                            <h3 class="widget-title">{{ __('main.Services') }}</h3>
                            <ul>
                                @foreach ($all_service as $single_service)
                                    <li>
                                        <a
                                            href="{{ route('front.single.service', $single_service->translateOrDefault(session()->get('locale'))->slug) }}">{{ $single_service->translateOrDefault(session()->get('locale'))->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-widget contact-widget">
                            <div class="media align-items-center">
                                <div class="icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="mt-0">{{ __('main.Call_For_Any_Help') }}</h4>
                                    <span>{{ $allsettings['helpline_1'] }}</span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-9 col-md-8">
                    <section class="service-details-area">
                        <div class="service-details-image">
                            <img src="{{ asset(path_service_image() . $service->image) }}"
                                alt="{{ $service->translateOrDefault(session()->get('locale'))->title }}" />
                        </div>
                        <h3 class="service-details-title">
                            {{ $service->translateOrDefault(session()->get('locale'))->title }}</h3>
                        <p class="service-details-content">
                            {{ $service->translateOrDefault(session()->get('locale'))->description }}</p>
                        {{ view_html($service->details) }}
                    </section>
                    <div class="pagination">
                        <ul class="pagination-wrap">
                            <li class="previous">
                                @if ($previous_service)
                                    <a
                                        href="{{ route('front.single.service', $previous_service->translateOrDefault(session()->get('locale'))->slug) }}">
                                        <span> <i class="flaticon-left-arrow"></i>
                                            {{ __('main.Previous_Services') }}</span>
                                        <h4>{{ $previous_service->title }}</h4>
                                    </a>
                                @endif
                            </li>
                            <li class="next">
                                @if ($next_service)
                                    <a
                                        href="{{ route('front.single.service', $next_service->translateOrDefault(session()->get('locale'))->slug) }}">
                                        <span>{{ __('main.Next_Services') }} <i class="flaticon-right-arrow"></i></span>
                                        <h4>{{ $next_service->title }}</h4>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service details end here  -->
    @include('front.include.doctor')
@endsection
