@extends('layouts.main')
@section('title', __('main.Page_Create'))
@section('content')
    <!-- push external head elements to head -->
    @push('head')
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
                            <h5>{{ __('main.Page') }}</h5>
                            <span>{{ __('main.Page_Create') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('page.index') }}">{{ __('main.Page') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('main.Page_Create') }}</h3>
                            @can('page-list')
                                <a class="btn btn-primary ml-auto" href="{{ route('page.index') }}">{{ __('main.List') }}</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="label">{{ __('main.Label') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="label" name="label"
                                    placeholder="{{ __('main.Label') }}" value="{{ old('label') }}">
                                <span class="text-danger">{{ __($errors->first('label')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="title">{{ __('main.Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ __('main.Title') }}" value="{{ old('title') }}">
                                <span class="text-danger">{{ __($errors->first('title')) }}</span>
                            </div>

                            <div class="form-group">
                                <label for="tags">{{ __('main.Tags') }} <span class="text-danger">*</span></label> <br>
                                <input type="text" id="tags" name="tags" class="form-control"
                                    value="{{ old('tags') }}">
                                <br>
                                <span class="text-danger">{{ __($errors->first('tags')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('main.Description') }} <span
                                        class="text-danger">*</span></label>
                                <textarea id="description" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                <span class="text-danger">{{ __($errors->first('description')) }}</span>
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
        <script src="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('js/tags-input-active.js') }}"></script>
        <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
        <script src="{{ asset('js/summernote.js') }}"></script>
    @endpush
@endsection
