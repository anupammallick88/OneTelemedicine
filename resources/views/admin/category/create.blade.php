@extends('layouts.main')
@section('title', __('main.Category_Create'))
@section('content')
    <!-- push external head elements to head -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Category') }}</h5>
                            <span>{{ __('main.Category_Create') }}</span>
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
                                    href="{{ route('category.index') }}">{{ __('main.Category') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="row">
                @include('include.message')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="name">{{ __('main.Name') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name"
                                        name="name_{{ $lang->prefix }}"
                                        placeholder="{{ __('main.Name') }} ({{ $lang->name }})">
                                    <span class="text-danger">{{ __($errors->first('name')) }}</span>
                                </div>
                            @endforeach
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
