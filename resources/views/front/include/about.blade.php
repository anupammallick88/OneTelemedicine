@if ($about_section != null)
    <!-- about area start here  -->
    <section class="about-area section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-xl-5">
                    <div class="about-image">
                        <img src="{{ asset(path_about_image() . $about_section->image) }}"
                            alt="{{ __('Iamge') }}" />
                    </div>
                </div>
                <div class="col-md-7 col-lg-6 col-xl-5">
                    <div class="about-info">
                        <h2 class="about-title">{{ $about_section->translateOrDefault(session()->get('locale'))->title }}
                        </h2>
                        <p class="about-subtitle">
                            {{ $about_section->translateOrDefault(session()->get('locale'))->description }}</p>
                        <ul class="features-lsit">
                            <li class="single-feature">
                                <div class="media align-items-center">
                                    <div class="icon">
                                        <i class="{{ $about_section->icon_one }}"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0">
                                            {{ $about_section->translateOrDefault(session()->get('locale'))->icon_one_title }}
                                        </h4>
                                        <p class="mb-0">
                                            {{ $about_section->translateOrDefault(session()->get('locale'))->icon_one_description }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="single-feature">
                                <div class="media align-items-center">
                                    <div class="icon">
                                        <i class="{{ $about_section->icon_two }}"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0">
                                            {{ $about_section->translateOrDefault(session()->get('locale'))->icon_two_title }}
                                        </h4>
                                        <p class="mb-0">
                                            {{ $about_section->translateOrDefault(session()->get('locale'))->icon_two_description }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="single-feature">
                                <div class="media align-items-center">
                                    <div class="icon">
                                        <i class="{{ $about_section->icon_three }}"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0">
                                            {{ $about_section->translateOrDefault(session()->get('locale'))->icon_three_title }}
                                        </h4>
                                        <p class="mb-0">
                                            {{ $about_section->translateOrDefault(session()->get('locale'))->icon_three_description }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <a href="{{ route('front.about') }}" class="primary-btn">{{ __('main.Read_More') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about area end here  -->
@endif
