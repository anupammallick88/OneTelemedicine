@extends('layouts.main')
@section('title', __('main.Social_Create'))
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
                            <h5>{{ __('main.Social_Media') }}</h5>
                            <span>{{ __('main.Social_Create') }}</span>
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
                                <a href="{{ route('site.social.index') }}">{{ __('main.Social_Media') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('site.social.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('main.Name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('main.Name') }}">
                                <span class="text-danger">{{ __($errors->first('name')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="url">{{ __('main.Url') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="url" name="url"
                                    placeholder="{{ __('main.Url') }}">
                                <span class="text-danger">{{ __($errors->first('url')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="class">{{ __('main.CSS Class') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="class" name="class"
                                    placeholder="{{ __('main.CSS Class') }}">
                                <span class="text-danger">{{ __($errors->first('class')) }}</span>
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
@endsection
