@if ($counter_section != null)
    <!-- counter area start here  -->
    <section class="counter-area section-top"
        style="background-image: url({{ asset(path_counter_image() . $counter_section->background_image) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="single-video">
                        <img src="{{ asset(path_counter_image() . $counter_section->image) }}"
                            alt="{{ __('Image') }}" />
                        <a class="video-btn popup-video" data-autoplay="true" data-vbtype="video"
                            href="{{ $counter_section->video }}"><i class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="counter-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="single-counter">
                                    <div class="media align-items-center">
                                        <div class="icon">
                                            <i class="{{ $counter_section->counter_one_icon }}"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="counter">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_one_count }}
                                            </h2>
                                            <p class="mb-0">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_one_title }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="single-counter">
                                    <div class="media align-items-center">
                                        <div class="icon">
                                            <i class="{{ $counter_section->counter_two_icon }}"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="counter">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_two_count }}
                                            </h2>
                                            <p class="mb-0">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_two_title }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="single-counter">
                                    <div class="media align-items-center">
                                        <div class="icon">
                                            <i class="{{ $counter_section->counter_three_icon }}"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="counter">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_three_count }}
                                            </h2>
                                            <p class="mb-0">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_three_title }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="single-counter">
                                    <div class="media align-items-center">
                                        <div class="icon">
                                            <i class="{{ $counter_section->counter_four_icon }}"></i>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="counter">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_four_count }}
                                            </h2>
                                            <p class="mb-0">
                                                {{ $counter_section->translateOrDefault(session()->get('locale'))->counter_four_title }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- counter area end here  -->
@endif
