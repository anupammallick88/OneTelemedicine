@extends('layouts.main')
@section('title', __('main.Notice_Edit'))
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Notice') }}</h5>
                            <span>{{ __('main.Notice_Edit') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('notice.index') }}">{{ __('main.Notice') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('notice.update', $notice->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @include('include.message')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="icon">{{ __('main.Icon_Class') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                    placeholder="{{ __('main.Icon Class') }}" value="{{ $notice->icon }}">
                                <span class="text-danger">{{ __($errors->first('icon')) }}</span>
                            </div>
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="title">{{ __('main.Title') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="title" name="title_{{ $lang->prefix }}" class="form-control ">{{ $notice->translateOrDefault($lang->prefix)->title }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('main.Description') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="description" name="description_{{ $lang->prefix }}" class="form-control ">{{ $notice->translateOrDefault($lang->prefix)->description }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('description')) }}</span>
                                </div>
                                <hr />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="button_text">{{ __('main.Button_Text') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <input id="button_text" type="text" class="form-control"
                                        name="button_text_{{ $lang->prefix }}" placeholder="{{ __('main.Button_Text') }}"
                                        value="{{ $notice->translateOrDefault($lang->prefix)->button_text }}">
                                    <span class="text-danger">{{ __($errors->first('button_text')) }}</span>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label for="button_url">{{ __('main.Button_Url') }} <span
                                        class="text-danger">*</span></label> <br>
                                <input type="text" id="button_url" name="button_url" class="form-control"
                                    placeholder="{{ __('main.Button Url') }}" value="{{ $notice->button_url }}">
                                <span class="text-danger">{{ __($errors->first('button_url')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('main.Status') }} <span class="text-danger">*</span> </label>
                                <select class="form-control select2" name="status">
                                    <option value="1" {{ $notice->status == 1 ? 'selected' : '' }}>
                                        {{ __('main.Publish') }}</option>
                                    <option value="2" {{ $notice->status == 2 ? 'selected' : '' }}>
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
    @endpush
@endsection
