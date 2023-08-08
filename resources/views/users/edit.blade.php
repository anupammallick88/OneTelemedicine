@extends('layouts.main')
@section('title', __('main.Admin_Edit'))
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
                            <span>{{ __('main.Admin_Edit') }}</span>
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
                                <a href="#">{{ __('main.Admin') }}</a>
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
                        <h3>{{ __('main.Admin_Edit') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __('main.Admin_Elements') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="forms-sample"
                                            action="{{ isset($user) ? route('user.update', $user->id) : '' }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">{{ __('main.First_Name') }}</label>
                                                        <input name="first_name" value="{{ $user->fname }}" type="text"
                                                            class="form-control" id="exampleInputName1"
                                                            placeholder="{{ __('main.First_Name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">{{ __('main.Last_Name') }}</label>
                                                        <input name="last_name" value="{{ $user->lname }}" type="text"
                                                            class="form-control" id="exampleInputName1"
                                                            placeholder="{{ __('main.Last_Name') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail3">{{ __('main.Email') }}</label>
                                                        <input name="email" type="email" value="{{ $user->email }}"
                                                            class="form-control" id="exampleInputEmail3"
                                                            placeholder="{{ __('main.Email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelectGender">{{ __('main.Gender') }}</label>
                                                        <select name="gender" class="form-control"
                                                            id="exampleSelectGender">
                                                            <option value="male"
                                                                {{ $user->gender == 'male' ? 'selected' : '' }}>
                                                                {{ __('main.Male') }}</option>
                                                            <option value="female"
                                                                {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                                {{ __('main.Female') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="role">{{ __('main.Role') }}</label>
                                                            <select name="roles[]" class="form-control" id="role">
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role }}"
                                                                        {{ in_array($role, $userRole) ? 'selected' : '' }}>
                                                                        {{ $role }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label
                                                            for="validatedInputGroupCustomFile1">{{ __('main.Image') }}</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input
                                                                    value="{{ isset($user) ? asset(path_user_image() . $user->image) : '' }}"
                                                                    name="image" type="file" class="custom-file-input"
                                                                    id="putImage">
                                                                <label data-id="showname" class="custom-file-label"
                                                                    for="validatedInputGroupCustomFile">{{ __('main.Choose_file___') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 mt-4">
                                                        @if (isset($user))
                                                            <img id="target" class="cus-mh50-mw-50"
                                                                src="{{ isset($user->image) ? asset(path_user_image() . $user->image) : Avatar::create($user->name)->toBase64() }}">
                                                        @else
                                                            <img src="{{ asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                                                id="target" class="cus-mh50-mw-50"
                                                                alt="{{ __('main.Image') }}">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="bio">{{ __('main.Bio') }}</label>

                                                <textarea id="summernote" name="bio" class="form-control my-editor" id="bio"
                                                    rows="4">{{ isset($user->bio) ? $user->bio : '' }}</textarea>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary mr-2">{{ __('main.Update') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 hide-mobile">
                                <div>
                                    <h5>{{ __('main.Admin Info') }}</h5>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="fname">{{ __('main.Name') }}</label>
                                        <input name="fname" type="text" class="form-control"
                                            value="{{ $user->name ?? '' }}" disabled>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="fname">{{ __('main.Email') }}</label>
                                        <input name="fname" type="text" class="form-control"
                                            value="{{ $user->email ?? '' }}" disabled>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <img class="cus-user-edit-img"
                                        src="{{ isset($user->image) ? asset(path_user_image() . $user->image) : asset(path_noimage_image() . 'no-image-200.jpg') }}"
                                        alt="{{ __('main.image') }}">
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
