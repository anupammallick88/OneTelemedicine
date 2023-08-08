@section('breadcrumb')
    <!-- breadcrumb area start here   -->
    <section class="breadcrumb-area cus-bg-user-img"
        style="background-image: url({{ asset(path_page_banner() . $allsettings['banner']) }})">
        <div class="container">
            <h2 class="page-title">{{ __(str_replace('-', ' ', request()->segment(1))) }}</h2>
            <ul class="breadcrumb-page">
                <li><a href="{{ url('/') }}">{{ __('main.Home') }}</a></li>
                <li>{{ __(str_replace('-', ' ', request()->segment(1))) }}</li>
            </ul>
        </div>
    </section>
    <!-- breadcrumb area end here   -->
@endsection
