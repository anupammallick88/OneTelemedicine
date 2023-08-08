@extends('layouts.main')
@section('title', __('main.Service_Edit'))
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
                            <h5>{{ __('main.Service') }}</h5>
                            <span>{{ __('main.Service_Edit') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('service.index') }}">{{ __('main.Service_Edit') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
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
                                        name="title_{{ $lang->prefix }}" placeholder="{{ __('main.Title_here') }}"
                                        value="{{ $service->translateOrDefault($lang->prefix)->title }}">
                                    <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('main.Description') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="description" name="description_{{ $lang->prefix }}" class="form-control" rows="5">{{ $service->translateOrDefault($lang->prefix)->description }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('description')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="details">{{ __('main.Details') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="details" name="details_{{ $lang->prefix }}" class="form-control html-editor">{{ $service->translateOrDefault($lang->prefix)->details }}</textarea>
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
                                    <img id="target" class="cus-mw-200"
                                        src="{{ asset(path_service_image() . $service->image) }}"
                                        alt="{{ __('main.test') }}">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="putImage">
                                            <label data-id="showname" class="custom-file-label"
                                                for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="image-group">
                                <div class="form-group">
                                    <label for="">{{ __('main.Icon') }} <span class="text-danger">*</span> </label>
                                    <br>
                                    <img id="target2" class="cus-mw-200"
                                        src="{{ asset(path_service_image() . $service->icon) }}"
                                        alt="{{ __('main.test') }}">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="icon" type="file" class="custom-file-input" id="putImage2">
                                        <label data-id="showname" class="custom-file-label"
                                            for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('icon') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input">{{ __('main.Tags') }} <span class="text-danger">*</span></label> <br>
                                <input type="text" id="tags" name="tags" class="form-control"
                                    value="{{ $service->tags }}">
                                <br>
                                <span class="text-danger">{{ $errors->first('tags') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('main.Status') }} <span class="text-danger">*</span> </label>
                                <select class="form-control select2" name="status">
                                    <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>
                                        {{ __('main.Publish') }}</option>
                                    <option value="2" {{ $service->status == 2 ? 'selected' : '' }}>
                                        {{ __('main.Draft') }}</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('status') }}</span>
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
