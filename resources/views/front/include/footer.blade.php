<!-- footer area start here  -->
<footer class="footer-area">
    <div class="footer-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="footer-logo">
                        <a href="{{ route('front.index') }}" class="footer-logo"><img
                                src="{{ isset($allsettings['white_logo']) ? asset(WHITE_LOGO . $allsettings['white_logo']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                alt="{{ __('logo') }}" /></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="newsletter-area d-flex justify-content-between align-items-center">
                        <h3 class="newsletter-title">{{ __('main.Subscribe_Newsletter') }}</h3>
                        <div>
                            <div class="newsletter-form">
                                <form action="{{ route('subscriber.store') }}" method="POST">
                                    @csrf
                                    <div class="newsletter-wrape">
                                        <input type="text" name="email" class="newsletter-input"
                                            placeholder="{{ __('main.Enter_your_Email_Here___') }}" required />
                                        <button class="newsletter-btn">{{ __('main.Submit') }}</button>
                                    </div>
                                </form>
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-widget text-widget">
                        <h3 class="widget-title">{{ __('main.Get_In_Touch') }}</h3>
                        <p>{{ $allsettings['address'] }}</p>
                        <ul>
                            <li><i class="fas fa-mobile-alt"></i> {{ __('main.Helpline_one') }}
                                {{ $allsettings['helpline_1'] }}</li>
                            <li><i class="fas fa-mobile-alt"></i> {{ __('main.Helpline_two') }}
                                {{ $allsettings['helpline_2'] }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-widget menu-widget">
                        <h3 class="widget-title">{!! __(menu_title(2)) !!} </h3>
                        <ul>
                            @foreach (quick_links_menu() as $quick_links_menu)
                                <li>
                                    <a
                                        href="{{ url($quick_links_menu->url) }}">{{ $quick_links_menu->translateOrDefault(session()->get('locale'))->label }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-widget menu-widget">
                        <h3 class="widget-title">{!! __(menu_title(3)) !!}</h3>
                        <ul>
                            @foreach (support_help_menu() as $support_help_menu)
                                <li>
                                    <a
                                        href="{{ url($support_help_menu->url) }}">{{ $support_help_menu->translateOrDefault(session()->get('locale'))->label }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-widget galley-widget">
                        <h3 class="widget-title">{{ __('main.Gallery') }}</h3>
                        <ul>
                            @foreach (footer_gallery() as $footer_gallery)
                                <li>
                                    <a
                                        href="{{ route('front.single.service', $footer_gallery->service->translateOrDefault(session()->get('locale'))->slug) }}">
                                        <img src="{{ asset(path_gallery_image() . $footer_gallery->image) }}"
                                            alt="{{ __('galley') }}" /></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="contaienr">
            <div class="copyright-area text-center">
                <p class="mb-0">&copy; {{ date('Y') }} {{ $allsettings['title'] }} .
                    {{ $allsettings['footer_copyright'] }}</p>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end here  -->
