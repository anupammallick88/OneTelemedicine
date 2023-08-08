@extends('layouts.main')
@section('title', __('main.Admin_Create'))
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
                            <h5>{{ __('main.Admin') }}</h5>
                            <span>{{ __('main.Admin_Create') }}</span>
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
                                <a href="#">{{ __('main.Admin_Create') }}</a>
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
                        <h3>{{ __('main.Admin_Create') }}</h3>
                        <a class="btn btn-primary ml-auto"
                            href="{{ route('admin.user.index') }}">{{ __('main.Admin_List') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __('main.Admin_Elements') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{ route('admin.user.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">{{ __('main.First_Name') }}</label>
                                                        <input name="first_name" type="text" class="form-control"
                                                            id="exampleInputName1" placeholder="{{ __('main.First_Name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">{{ __('main.Last_Name') }}</label>
                                                        <input name="last_name" type="text" class="form-control"
                                                            id="exampleInputName1" placeholder="{{ __('main.Last_Name') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">{{ __('main.Email') }}</label>
                                                        <input name="email" type="email" class="form-control"
                                                            id="exampleInputEmail3" placeholder="{{ __('main.Email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">{{ __('main.Password') }}</label>
                                                        <input name="password" type="password" class="form-control"
                                                            id="exampleInputEmail3" placeholder="{{ __('main.Password') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleSelectGender">{{ __('main.Gender') }}</label>
                                                        <select name="gender" class="form-control"
                                                            id="exampleSelectGender">
                                                            <option value="male">{{ __('main.Male') }}</option>
                                                            <option value="female">{{ __('main.Female') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="role">{{ __('main.Role') }}</label>
                                                        <select name="roles[]" class="form-control" id="role">
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role }}">{{ $role }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="validatedInputGroupCustomFile1">{{ __('main.Image') }}</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input
                                                                    value="{{ isset($user) ? asset(path_user_image() . $user->image) : '' }}"
                                                                    name="thumb_image" type="file" class="custom-file-input"
                                                                    id="putImage">
                                                                <label data-id="showname" class="custom-file-label"
                                                                    for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mt-4">
                                                    @if (isset($user))
                                                        <img id="target" class="cus-mh50-mw-50"
                                                            src="{{ isset($user->image) ? asset(path_user_image() . $user->image) : Avatar::create($user->name)->toBase64() }}">
                                                    @else
                                                        <img src="{{ asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                                            id="target" class="cus-mh50-mw-50" alt="{{ __('main.image') }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary mr-2">{{ __('main.Submit') }}</button>
                                        </form>
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
