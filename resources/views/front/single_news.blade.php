@extends('front.layouts.main')
@include('front.include.breadcrumb')
@section('page_title', $news->translateOrDefault(session()->get('locale'))->title)
@section('page_description', $news->translateOrDefault(session()->get('locale'))->description)
@section('page_tags', $news->tags)
@section('content')
    <!-- service details start here  -->
    <div class="service-details section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <aside class="sidebar-widget ">
                        <div class="single-widget catagory-widget">
                            <h3 class="widget-title">{{ __('main.category') }}</h3>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('front.category', $category->translateOrDefault(session()->get('locale'))->slug) }}">{{ $category->translateOrDefault(session()->get('locale'))->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-widget recent-posts-widget">
                            <h3 class="widget-title">{{ __('main.Recent_Posts') }}</h3>
                            <ul>
                                @foreach ($recent_news as $news_item)
                                    <li>
                                        <a
                                            href="{{ route('front.single.news', $news_item->translateOrDefault(session()->get('locale'))->slug) }}">
                                            <div class="media align-items-center">
                                                <div class="post-image">
                                                    <img src="{{ asset(path_news_image() . $news_item->image) }}"
                                                        alt="{{ $news_item->image_alt }}" />
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="post-title mt-0">
                                                        {{ strlen($news_item->title) > 20 ? substr($news_item->translateOrDefault(session()->get('locale'))->title, 0, 20) . '...' : $news_item->translateOrDefault(session()->get('locale'))->title }}
                                                    </h4>
                                                    <ul class="post-meta">
                                                        <li><img class="author-name"
                                                                src="{{ asset(path_user_image() . $news_item->user->image) }}"
                                                                alt="{{ $news_item->user->name }}" /></li>
                                                        <li>{{ $news_item->created_at->format('M d. Y') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-widget tag-widget">
                            <h3 class="widget-title">{{ __('main.Popular_Tag') }}</h3>
                            <ul>
                                @foreach (explode(',', $news->tags) as $tag)
                                    <li><a href="{{ route('front.tag', $tag) }}">{{ ucwords($tag) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="blog-details-area">
                        <div class="blog-img">
                            <img src="{{ asset(path_news_image() . $news->image) }}" alt="{{ $news->image_alt }}" />
                        </div>
                        <div class="post-meta-wrap">
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
                                <li> <i class="flaticon-calendar"></i> {{ $news->created_at->format('M d. Y') }}</li>
                            </ul>
                            <div class="social-share">
                                <ul>
                                    <li>{{ __('main.Share') }}:</li>
                                    <li class="facebook"><a
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}&display=popup"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li class="twiter"><a
                                            href="https://twitter.com/intent/tweet?url={{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}&text={{ $news->translateOrDefault(session()->get('locale'))->title }}"><i
                                                class="fab fa-twitter"></i></a></li>
                                    <li class="instagram"><a
                                            href="https://www.instagram.com/?{{ route('front.single.news', $news->translateOrDefault(session()->get('locale'))->slug) }}"><i
                                                class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <h2 class="post-title">{{ $news->translateOrDefault(session()->get('locale'))->title }}</h2>
                        <p class="post-conent">{{ $news->translateOrDefault(session()->get('locale'))->description }}</p>
                        <div class="post-inner-text">
                            {{ view_html($news->translateOrDefault(session()->get('locale'))->details) }}
                        </div>
                        <div class="post-tag">
                            <ul>
                                <li><span>{{ __('main.Popular_Tag') }}:</span></li>
                                @foreach (explode(',', $news->tags) as $tag)
                                    <li><a href="#">{{ ucwords($tag) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="pagination">
                        <ul class="pagination-wrap">
                            <li class="previous">
                                @if ($previous_news)
                                    <a
                                        href="{{ route('front.single.news', $previous_news->translateOrDefault(session()->get('locale'))->slug) }}">
                                        <span> <i class="flaticon-left-arrow"></i> {{ __('main.Previous_Post') }}</span>
                                        <h4>{{ Str::limit($previous_news->translateOrDefault(session()->get('locale'))->title, '40', '...') }}
                                        </h4>
                                    </a>
                                @endif
                            </li>
                            <li class="next">
                                @if ($next_news)
                                    <a
                                        href="{{ route('front.single.news', $next_news->translateOrDefault(session()->get('locale'))->slug) }}">
                                        <span>{{ __('main.Next_Post') }} <i class="flaticon-right-arrow"></i></span>
                                        <h4>{{ Str::limit($next_news->translateOrDefault(session()->get('locale'))->title, '40', '...') }}
                                        </h4>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="comment-area">
                        <h2 class="comment-title">{{ __('main.Comment') }}
                            ({{ App\Models\Admin\Comment::where('status', 1)->count() }})</h2>
                        <ul class="comment-list">
                            @foreach ($comments as $comment)
                                <li class="single-comment">
                                    <div class="media">
                                        <div class="user-image">
                                            <img src="{{ asset(path_user_image() . $comment->user->image) }}"
                                                alt="{{ $comment->user->name }}" />
                                        </div>
                                        <div class="media-body">
                                            <h4 class="author-name mt-0">{{ $comment->user->name }} <span
                                                    class="time">{{ $comment->created_at->format('M d. Y') }}</span></h4>
                                            <p class="comment-text">{{ view_html($comment->massage) }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="comment-form" id="comment-form">
                        <h2 class="form-title">{{ __('main.Leave_a_Replay') }}</h2>
                        @if (Auth::check())
                            <form action="{{ route('comment.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="message">{{ __('main.Your_Messages') }}</label>
                                    <textarea class="form-control comment-box" id="message" name="massage" rows="3"
                                        placeholder="{{ __('main.Your_Messages') }}"></textarea>
                                    <span class="text-danger">{{ __($errors->first('massage')) }}</span>
                                    <input type="hidden" name="p_id" value="{{ $newsId->id }}">
                                </div>
                                <button type="submit" class="primary-btn">{{ __('main.Post_Comment') }}</button>
                            </form>
                        @else
                            <h4>{{ __('main.Please') }} <a href="{{ route('signin') }}">{{ __('main.login') }}</a>
                                {{ __('main.to_leave_your_comment') }}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service details end here  -->
@endsection
