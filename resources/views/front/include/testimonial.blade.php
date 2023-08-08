@if ($testimonials->count() > 0)
    <!-- testimonial area start here  -->
    <section class="testimonial-area section">
        <div class="container">
            <div class="section-title text-center">
                <div class="row">
                    @if (section_title('testimonial-section') != null)
                        <div class="col-lg-12">
                            <h2 class="title">
                                {{ section_title('testimonial-section')->translateOrDefault(session()->get('locale'))->title }}
                            </h2>
                            <p class="subtitle">
                                {{ section_title('testimonial-section')->translateOrDefault(session()->get('locale'))->description }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="testimonial-slide">
                @foreach ($testimonials as $testimonial)
                    <div class="single-testimonial">
                        <div class="clint-info">
                            <div class="media align-items-center">
                                <div class="testimonial-image">
                                    <img src="{{ asset(path_testimonial_image() . $testimonial->image) }}"
                                        alt="{{ $testimonial->title }}" />
                                </div>
                                <div class="media-body">
                                    <h4 class="mt-0">{{ $testimonial->name }}</h4>
                                    <p class="mb-0">{{ $testimonial->occupation }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-info">
                            <h3>{{ $testimonial->title }}</h3>
                            <p>{{ view_html($testimonial->description) }}</p>
                            <ul class="review-area">
                                @for ($i = 1; $i <= $testimonial->star; $i++)
                                    <li><i class="fas fa-star"></i></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- testimonial area end here  -->
@endif
