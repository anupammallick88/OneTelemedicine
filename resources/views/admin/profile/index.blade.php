@extends('layouts.main')
@section('title', __('User Profile'))
@push('head')
<!-- include summernote css/js -->
<link href="{{ asset('plugins/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Admin')}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Profile')}}</a>
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
                    <h3>{{ __('Admin Profile')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ __('Admin Profile elements')}}</h3>
                                </div>
                                <div class="card-body">
                                    <form class="forms-sample" action="{{isset($user) ? route('admin.update', $user->id): route('users.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Name') }}</label>
                                            <input name="name" type="text" value="{{isset($user->name) ? $user->name : ''}}" class="form-control" id="exampleInputName1" placeholder="{{ __('Name') }}">
                                            <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Email') }}</label>
                                            <input name="email" type="text" value="{{isset($user->email) ? $user->email : ''}}" class="form-control" id="exampleInputName1" placeholder="{{ __('Email') }}">
                                            <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Password') }}</label>
                                            <input name="password" type="password" class="form-control" id="exampleInputName1" placeholder="{{ __('Password') }}">
                                            <span class="text-danger">{{ __($errors->first('password')) }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">{{ __('Confirm Password') }}</label>
                                            <input name="password_confirmation" type="password" class="form-control" id="exampleInputName1" placeholder="{{ __('Confirm password') }}">
                                            <span class="text-danger">{{ __($errors->first('password_confirmation')) }}</span>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Image')}} <span class="text-danger">*</span> </label> <br>
                                                        <img id="target" class="cus-mw-200" src="{{isset($user->image) ? asset(path_user_image() . $user->image) : asset(path_noimage_image().'no-image-200.jpg') }}" alt="{{ __('image') }}">
                                                    </div>
                                                    <!-- file manager -->
                                                    <div class="image-group">
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="image" type="file" class="custom-file-input" id="putImage">
                                                                <label data-id="showname" class="custom-file-label" for="validatedInputGroupCustomFile">{{ __('Choose file...') }}</label>
                                                            </div>
                                                        </div>
                                                        <!-- file manager -->
                                                        <span class="text-danger">{{ __($errors->first('image')) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit')}}</button>
                                        </div>
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
<script src="{{asset('js/summernote.js')}}"></script>
@endpush