@extends('layouts.main')
@section('title', __('main.Category_Create'))
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
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Category') }}</h5>
                            <span>{{ __('main.Category') }}</span>
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
                                <a href="#">{{ __('main.Category') }}</a>
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
                        @isset($category)
                            <h3>{{ __('main.Category_Edit') }}</h3>
                        @else
                            <h3>{{ __('main.Category_Create') }}</h3>
                        @endisset
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        @isset($category)
                                            <h3>{{ __('main.Category_Edit') }}</h3>
                                        @else
                                            <h3>{{ __('main.Category_Create') }}</h3>
                                        @endisset
                                    </div>
                                    <div class="card-body">
                                        <form class="forms-sample"
                                            action="{{ isset($category) ? route('doctor.category.update', $category->id) : route('doctor.category.create') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Name') }}</label>
                                                <input name="name" type="text"
                                                    value="{{ isset($category) ? $category->name : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Name') }}">
                                                <span class="text-danger">{{ __($errors->first('name')) }}</span>
                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2">
                                                {{ isset($category) ? __('main.Update') : __('main.Submit') }}</button>
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
