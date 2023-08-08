@extends('layouts.main')
@section('title', __('main.Gallery_Edit'))
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
                            <h5>{{ __('main.Galleries') }}</h5>
                            <span>{{ __('main.Gallery_Edit') }}</span>
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
                                    href="{{ route('gallery.index') }}">{{ __('main.Galleries') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="image-group">
                                <div class="form-group">
                                    <label for="">{{ __('main.Image') }} <span class="text-danger">*</span> </label>
                                    <br>
                                    <img id="target" class="cus-mw-200"
                                        src="{{ asset(path_gallery_image() . $gallery->image) }}"
                                        alt="{{ __('main.Image') }}">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input
                                                value="{{ isset($user) ? asset(path_user_image() . $user->image) : '' }}"
                                                name="image" type="file" class="custom-file-input" id="putImage">
                                            <label data-id="showname" class="custom-file-label"
                                                for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ __($errors->first('image')) }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('main.Service') }} <span class="text-danger">*</span>
                                </label>
                                <select class="form-control select2" name="service_id">
                                    @foreach ($services as $service_name)
                                        <option {{ $gallery->service_id == $service_name->id ? 'selected' : '' }}
                                            value="{{ $service_name->id }}">
                                            {{ Str::ucfirst($service_name->translateOrDefault(session()->has('locale'))->title) }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ __($errors->first('service_id')) }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                                <a href="#" class="btn btn-light">{{ __('main.Cancel') }}</a>
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
        <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
        <script src="{{ asset('js/select2-active-new.js') }}"></script>
    @endpush
@endsection
