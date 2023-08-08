@extends('layouts.main')
@section('title', __('main.News_Create'))
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote.min.css') }}">
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
                            <h5>{{ __('main.News') }}</h5>
                            <span>{{ __('main.News_Create') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">{{ __('main.News') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @include('include.message')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="title">{{ __('main.Title') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title"
                                        name="title_{{ $lang->prefix }}" placeholder="{{ __('main.Title') }}">
                                    <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('main.Description') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="description" name="description_{{ $lang->prefix }}" class="form-control" rows="4"></textarea>
                                    <span class="text-danger">{{ __($errors->first('description')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="details">{{ __('main.Details') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="details" name="details_{{ $lang->prefix }}" class="form-control html-editor"></textarea>
                                    <span class="text-danger">{{ __($errors->first('details')) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="image-group">
                                <div class="form-group">
                                    <label for="">{{ __('main.Image') }} <span class="text-danger">*</span>
                                    </label>
                                    <br>
                                    <img id="target" class="target cus-mw-200"
                                        src="{{ asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                        alt="{{ __('main.test') }}">
                                </div>
                                <div class="custom-file">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="putImage">
                                            <label data-id="showname" class="custom-file-label"
                                                for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger">{{ __($errors->first('image')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="image_alt">{{ __('main.Image_Alt') }} <span
                                        class="text-danger">*</span></label>
                                <input id="image_alt" type="text" class="form-control" name="image_alt"
                                    placeholder="{{ __('main.Image_Alt') }}">
                                <span class="text-danger">{{ __($errors->first('image_alt')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('main.Category') }} <span class="text-danger">*</span> </label>
                                <select class="form-control select2" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->translateOrDefault(session()->has('locale'))->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ __($errors->first('category_id')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="input">{{ __('main.Tags') }} <span class="text-danger">*</span></label> <br>
                                <input type="text" id="tags" name="tags" class="form-control">
                                <br>
                                <span class="text-danger">{{ __($errors->first('tags')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('main.Status') }} <span class="text-danger">*</span> </label>
                                <select class="form-control select2" name="status">
                                    <option value="1">{{ __('main.Publish') }}</option>
                                    <option value="2">{{ __('main.Draft') }}</option>
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
        <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
        <script src="{{ asset('js/summernote.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
        <script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <script src="{{ asset('js/select2-active.js') }}"></script>
    @endpush
@endsection
