@extends('layouts.main')
@section('title', __('main.Slider_Edit'))
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Slider') }}</h5>
                            <span>{{ __('main.Slider_Edit') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">{{ __('main.Slider') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @include('include.message')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="icon">{{ __('main.Icon_Class') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                    placeholder="{{ __('main.Icon Class') }}" value="{{ $slider->icon }}">
                                <span class="text-danger">{{ __($errors->first('icon')) }}</span>
                            </div>
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="small_heading">{{ __('main.Small_Heading') }}
                                        ({{ $lang->name }})
                                        <span class="text-danger">*</span></label>
                                    <textarea id="small_heading" name="small_heading_{{ $lang->prefix }}" class="form-control" rows="4">{{ $slider->translateOrDefault($lang->prefix)->small_heading }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('small_heading')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="big_heading">{{ __('main.Big_Heading') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="big_heading" name="big_heading_{{ $lang->prefix }}" class="form-control" rows="4">{{ $slider->translateOrDefault($lang->prefix)->big_heading }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('big_heading')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('main.Description') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="description" name="description_{{ $lang->prefix }}" class="form-control" rows="6">{{ $slider->translateOrDefault($lang->prefix)->description }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('description')) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">{{ __('main.Image') }} <span class="text-danger">*</span> </label>
                                <br>
                                <img id="target" class="cus-mw-200"
                                    src="{{ asset(path_slider_image() . $slider->image) }}" alt="{{ __('main.image') }}">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input" id="putImage">
                                        <label data-id="showname" class="custom-file-label"
                                            for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                    </div>
                                </div>
                                <span class="text-danger">{{ __($errors->first('image')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('main.Status') }} <span class="text-danger">*</span> </label>
                                <select class="form-control select2" name="status">
                                    <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>
                                        {{ __('main.Publish') }}</option>
                                    <option value="2" {{ $slider->status == 2 ? 'selected' : '' }}>
                                        {{ __('main.Draft') }}</option>
                                </select>
                                <span class="text-danger">{{ __($errors->first('status')) }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
        <script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <script src="{{ asset('js/select2-active-new.js') }}"></script>
        <script src="{{ asset('js/tags-input-active.js') }}"></script>
    @endpush
@endsection
