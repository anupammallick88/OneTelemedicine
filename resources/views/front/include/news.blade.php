<!-- blog area start here  -->
<section class="blog-area section-top pb-90">
    <div class="container">
        <div class="section-title text-center">
            <div class="row">
                @if (section_title('news-section') != null)
                    <div class="col-lg-12">
                        <h2 class="title">
                            {{ section_title('news-section')->translateOrDefault(session()->get('locale'))->title }}
                        </h2>
                        <p class="subtitle">
                            {{ section_title('news-section')->translateOrDefault(session()->get('locale'))->description }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @foreach ($all_news as $news)
                    @if ($loop->iteration == 1)
                        <div class="single-grid-blog">
                            <div class="blog-thumbnail">
                                <a
                                    href="{{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}"><img
                                        src="{{ asset(path_news_image() . $news->image) }}"
                                        alt="{{ $news->image_alt }}" /></a>
                            </div>
                            <div class="blog-info">
                                <h3 class="blog-title"><a
                                        href="{{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}">{{ $news->translateOrDefault(session()->get('locale'))->title }}</a>
                                </h3>
                                <ul class="blog-meta">
                                    <li>
                                        <div class="author-info">
                                            <div class="author-image">
                                                <img src="{{ asset(path_user_image() . $news->user->image) }}"
                                                    alt="{{ $news->user->name }}" />
                                            </div>
                                            <h4 class="author-name">{{ $news->user->name }}</h4>
                                        </div>
                                    </li>
                                    <li> <i class="flaticon-calendar"></i> {{ $news->created_at->format('M d. Y') }}
                                    </li>
                                </ul>
                                <p class="blog-content">
                                    {{ $news->translateOrDefault(session()->get('locale'))->description }}</p>
                                <a class="redmore-btn"
                                    href="{{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}">{{ __('main.Read_More') }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-md-6">
                @foreach ($all_news as $news)
                    @if ($loop->iteration > 1)
                        <div class="single-grid-blog">
                            <div class="blog-info">
                                <h3 class="blog-title"><a
                                        href="{{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}">{{ strlen($news->title) > 45 ? substr($news->translateOrDefault(session()->get('locale'))->title, 0, 45) . '...' : $news->translateOrDefault(session()->get('locale'))->title }}</a>
                                </h3>
                                <ul class="blog-meta">
                                    <li>
                                        <div class="author-info">
                                            <div class="author-image">
                                                <img src="{{ asset(path_user_image() . $news->user->image) }}"
                                                    alt="{{ $news->user->name }}" />
                                            </div>
                                            <h4 class="author-name">{{ $news->user->name }}</h4>
                                        </div>
                                    </li>
                                    <li> <i class="flaticon-calendar"></i> {{ $news->created_at->format('M d, Y') }}
                                    </li>
                                </ul>
                                <p class="blog-content">
                                    {{ $news->translateOrDefault(session()->get('locale'))->description }}</p>
                                <a class="redmore-btn"
                                    href="{{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}">{{ __('main.Read_More') }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="view-more-btn">
                    <a class="primary-btn" href="{{ route('front.news') }}">{{ __('main.More_View') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog area end here  -->
