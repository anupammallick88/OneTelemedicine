@extends('layouts.main')
@section('title', __('main.Site_Settings'))
@push('head')
    <!-- include summernote css/js -->
    <link href="{{ asset('plugins/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-sites bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Site_Settings') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('main.Site_Settings') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header">
                        <h3>{{ __('main.Site_Settings') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __('main.Site_Elements') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{ route('sites.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Title') }}</label>
                                                <input name="title" type="text"
                                                    value="{{ $allsettings['title'] ?? $allsettings['title'] }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Title') }}">
                                                <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Site_Address') }}</label>
                                                <input name="address" type="text"
                                                    value="{{ $allsettings['address'] ?? $allsettings['address'] }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Address') }}">
                                                <span class="text-danger">{{ __($errors->first('address')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Site_Helpline_1') }}</label>
                                                <input name="helpline_1" type="text"
                                                    value="{{ $allsettings['helpline_1'] ?? $allsettings['helpline_1'] }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Site_Helpline_1') }}">
                                                <span class="text-danger">{{ __($errors->first('helpline1')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Site_Helpline_2') }}</label>
                                                <input name="helpline_2" type="text"
                                                    value="{{ $allsettings['helpline_2'] ?? $allsettings['helpline_2'] }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Site_Helpline_2') }}">
                                                <span class="text-danger">{{ __($errors->first('helpline2')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Helpline_Email_1') }}</label>
                                                <input name="helpline_email_1" type="text"
                                                    value="{{ $allsettings['helpline_email_1'] ?? $allsettings['helpline_email_1'] }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Helpline_Email_1') }}">
                                                <span
                                                    class="text-danger">{{ __($errors->first('helpline_email1')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Helpline_Email_2') }}</label>
                                                <input name="helpline_email_2" type="text"
                                                    value="{{ $allsettings['helpline_email_2'] ?? $allsettings['helpline_email_2'] }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Helpline_Email_2') }}">
                                                <span
                                                    class="text-danger">{{ __($errors->first('helpline_email2')) }}</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleInputEmail3">{{ __('main.Footer_Copyright') }}</label>
                                                        <input name="footer_copyright" type="text"
                                                            value="{{ $allsettings['footer_copyright'] ?? $allsettings['footer_copyright'] }}"
                                                            class="form-control" id="exampleInputEmail3"
                                                            placeholder="{{ __('main.Footer Copyright') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('footer_copyright')) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="language_id">{{ __('main.Default_Language') }}</label>
                                                        <select name="language_id" id="language_id" class="form-control">
                                                            @foreach (allLanguages() as $lang)
                                                                <option value="{{ $lang->id }}">{{ $lang->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>



                                                        <span
                                                            class="text-danger">{{ __($errors->first('footer_copyright')) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>{{ __('main.Site_Logo') }}</label>
                                                        <!-- file manager -->
                                                        <div class="image-group">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="site_logo" type="file"
                                                                        class="custom-file-input" id="putImage">
                                                                    <label data-id="showname" class="custom-file-label"
                                                                        for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                                </div>
                                                            </div>
                                                            <!-- file manager -->
                                                            <span
                                                                class="text-danger">{{ __($errors->first('site_logo')) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>{{ __('main.Site_Favicon') }}</label>
                                                        <!-- file manager -->
                                                        <div class="image-group">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="favicon" type="file"
                                                                        class="custom-file-input" id="putImage2">
                                                                    <label data-id="showname" class="custom-file-label"
                                                                        for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                                </div>
                                                            </div>
                                                            <!-- file manager -->
                                                            <span
                                                                class="text-danger">{{ __($errors->first('favicon')) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 pt-2">
                                                        <label>{{ __('main.White Logo') }}</label>
                                                        <!-- file manager -->
                                                        <div class="image-group">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="white_logo" type="file"
                                                                        class="custom-file-input" id="putImage3">
                                                                    <label data-id="showname" class="custom-file-label"
                                                                        for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                                </div>
                                                            </div>
                                                            <!-- file manager -->
                                                            <span
                                                                class="text-danger">{{ __($errors->first('white_logo')) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 pt-2">
                                                        <label>{{ __('main.Preloader Logo') }}</label>
                                                        <!-- file manager -->
                                                        <div class="image-group">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="preloader" type="file"
                                                                        class="custom-file-input" id="putImage3">
                                                                    <label data-id="showname" class="custom-file-label"
                                                                        for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                                </div>
                                                            </div>
                                                            <!-- file manager -->
                                                            <span
                                                                class="text-danger">{{ __($errors->first('preloader')) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 pt-2">
                                                        <label>{{ __('main.Page Banner') }}</label>
                                                        <!-- file manager -->
                                                        <div class="image-group">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="banner" type="file"
                                                                        class="custom-file-input" id="putImage3">
                                                                    <label data-id="showname" class="custom-file-label"
                                                                        for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                                </div>
                                                            </div>
                                                            <!-- file manager -->
                                                            <span
                                                                class="text-danger">{{ __($errors->first('banner')) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <button type="submit"
                                                    class="btn btn-primary mr-2">{{ __('main.Submit') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <h5>{{ __('main.Site_Info') }}</h5>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="fname">{{ __('main.Title') }}</label>
                                        <input name="fname" type="text" class="form-control"
                                            value="{{ $allsettings['title'] ?? $allsettings['title'] }}" disabled>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="fname">{{ __('main.Footer_Copyright') }}</label>
                                        <input name="fcopy" type="text" class="form-control"
                                            value="{{ $allsettings['footer_copyright'] ?? $allsettings['footer_copyright'] }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="form-group-wrap">
                                    <div class="row">


                                        <div class="form-group">
                                            <div class="">{{ __('main.Site_Logo') }}</div>
                                            <br>
                                            <img class="cus-site-create-logo"
                                                src="{{ isset($allsettings['site_logo']) ? asset(SITE_LOGO . $allsettings['site_logo']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                                alt="{{ __('main.image') }}" id="target">
                                        </div>
                                        <div class="form-group">
                                            <div class=" form-group">
                                                <div>{{ __('main.Site_Favicon') }}</div>
                                                <br>
                                                <img class="cus-site-create-logo"
                                                    src="{{ isset($allsettings['favicon']) ? asset(FAVICON . $allsettings['favicon']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                                    alt="{{ __('main.image') }}" id="target2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class=" form-group">
                                                <div>{{ __('main.White_Logo') }}</div>
                                                <br>
                                                <img class="cus-site-create-logo"
                                                    src="{{ isset($allsettings['white_logo']) ? asset(WHITE_LOGO . $allsettings['white_logo']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                                    alt="{{ __('main.image') }}" id="target3">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div>{{ __('main.Preloader') }}</div>
                                                <br>
                                                <img class="cus-site-create-logo"
                                                    src="{{ isset($allsettings['preloader']) ? asset(PRELOADER_IMG . $allsettings['preloader']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                                    alt="{{ __('main.image') }}" id="target4">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class=" form-group">
                                                <div>{{ __('main.Page_Banner') }}</div>
                                                <br>
                                                <img class="cus-site-create-logo"
                                                    src="{{ isset($allsettings['banner']) ? asset(PAGE_BANNER . $allsettings['banner']) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                                    alt="{{ __('main.image') }}" id="target5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- push external js -->
@push('script')
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
@endpush
