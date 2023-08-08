@extends('layouts.main')
@section('title', __('main.Doctor_Create'))
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
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Doctors') }}</h5>
                            <span>{{ __('main.Doctor_Create') }}</span>
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
                                <a href="#">{{ __('main.Doctor_Create') }}</a>
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
                        <h3>{{ __('main.Doctor_Create') }}</h3>
                        <a class="btn btn-primary ml-auto" href="{{ route('doctor.index') }}">{{ __('main.List') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('doctor.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Name') }}</label>
                                                <div class="col-md-6">
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" autocomplete="name"
                                                        autofocus>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.E-Mail_Address') }}</label>
                                                <div class="col-md-6">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" autocomplete="email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Password') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" autocomplete="off">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password-confirm"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Confirm_Password') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                        name="password_confirmation" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="docat"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Gender') }}</label>
                                                <div class="col-md-6">
                                                    <select class="form-select form-control" name="gender">
                                                        <option value="male">{{ __('main.Male') }}</option>
                                                        <option value="female">{{ __('main.Female') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="docat"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Doctor_Category') }}</label>
                                                <div class="col-md-6">
                                                    <select class="form-select form-control" name="docat">
                                                        @foreach ($category as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4 col-form-label text-md-right"><label for="text-input"
                                                        class=" form-control-label">{{ __('main.Off_Day') }}</label></div>
                                                <div class="col-md-6">
                                                    <input name="off_day[]" value="sat" type="checkbox">
                                                    {{ __('main.Saturday') }}
                                                    <input name="off_day[]" value="sun" type="checkbox">
                                                    {{ __('main.Sunday') }}
                                                    <input name="off_day[]" value="mon" type="checkbox">
                                                    {{ __('main.Monday') }}
                                                    <input name="off_day[]" value="tue" type="checkbox">
                                                    {{ __('main.Tuesday') }}
                                                    <input name="off_day[]" value="wed" type="checkbox">
                                                    {{ __('main.Wednesday') }}
                                                    <input name="off_day[]" value="thu" type="checkbox">
                                                    {{ __('main.Thursday') }}
                                                    <input name="off_day[]" value="fri" type="checkbox">
                                                    {{ __('main.Friday') }}
                                                    <small
                                                        class="form-text text-muted">{{ __('main.Check_off_day') }}</small>
                                                    @error('hospital_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row row">
                                                <div class="col-md-4 col-form-label text-md-right">
                                                    <p>{{ __('main.Fees') }}($)</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mr-4">
                                                        <input type="number" class="form-control" name="fees"
                                                            value="10" placeholder="{{ __('main.Fees') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Profile_Image') }}</label>
                                                <div class="col-md-7">
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input
                                                                        value="{{ isset($user) ? asset(path_user_image() . $user->image) : '' }}"
                                                                        name="profile_image" type="file"
                                                                        class="custom-file-input" id="putImage">
                                                                    <label data-id="showname" class="custom-file-label"
                                                                        for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            @if (isset($user))
                                                                <img id="target" class="cus-mh50-mw-50"
                                                                    src="{{ isset($user->image) ? asset(path_user_image() . $user->image) : Avatar::create($user->name)->toBase64() }}">
                                                            @else
                                                                <img src="{{ asset(path_noimage_image() . 'no-image-50.jpg') }}"
                                                                    id="target" class="cus-mh50-mw-50"
                                                                    alt="{{ __('main.image') }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Thumb_Image') }}</label>
                                                <div class="col-md-7">
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input
                                                                        value="{{ isset($user) ? asset(path_user_image() . $user->image) : '' }}"
                                                                        name="thumb_image" type="file"
                                                                        class="custom-file-input" id="putImage1">
                                                                    <label data-id="showname" class="custom-file-label"
                                                                        for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            @if (isset($user))
                                                                <img id="target1" class="cus-mh50-mw-50"
                                                                    src="{{ isset($user->image) ? asset(path_user_image() . $user->image) : Avatar::create($user->name)->toBase64() }}">
                                                            @else
                                                                <img src="{{ asset(path_noimage_image() . 'no-image-50.jpg') }}"
                                                                    id="target1" class="cus-mh50-mw-50"
                                                                    alt="{{ __('main.image') }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('main.Register') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- markup -->
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
