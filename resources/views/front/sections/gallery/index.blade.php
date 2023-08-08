@extends('layouts.main')
@section('title', __('main.Gallery_Section'))
@section('content')
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Gallery_Section') }}</h5>
                            <span>{{ __('main.Gallery_Section_Edit') }}</span>
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
                                <a href="{{ route('gallery.index') }}">{{ __('main.Gallery_Section') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            @include('include.message')
            <div class="col-lg-6">
                <form action="{{ route(!empty($gallery) ? 'gallery_section.update' : 'gallery_section.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="image-group">
                                <div class="form-group">
                                    <label for="">{{ __('main.Image') }} <span class="text-danger">*</span> </label>
                                    <br>
                                    <img id="target" class="cus-mw-200"
                                        src="{{ !empty($gallery) ? asset(path_gallery_image() . $gallery->image) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                        alt="{{ __('main.test') }}">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input
                                                value="{{ isset($gallery) ? asset(path_gallery_image() . $gallery->image) : '' }}"
                                                name="image" type="file" class="custom-file-input" id="putImage">
                                            <label data-id="showname" class="custom-file-label"
                                                for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <!-- Section -->
                <form action="{{ route('section.title.store', 'gallery-section') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('main.Gallery_Section') }}</h3>
                        </div>
                        <div class="card-body">
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="title">{{ __('main.Title') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title"
                                        name="title_{{ $lang->prefix }}" placeholder="{{ __('main.Title') }}"
                                        value="{{ section_title('gallery-section') ? section_title('gallery-section')->translateOrDefault($lang->prefix)->title : '' }}">
                                    <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('main.Description') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="description" name="description_{{ $lang->prefix }}" class="form-control" rows="5">{{ section_title('gallery-section') ? section_title('gallery-section')->translateOrDefault($lang->prefix)->description : '' }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('description')) }}</span>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
    @endpush
@endsection
