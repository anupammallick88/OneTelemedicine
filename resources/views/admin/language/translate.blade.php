@extends('layouts.main')
@section('title', __('main.Translate_Edit'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Translate') }}</h5>
                            <span>{{ __('main.Translate_Edit') }}</span>
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
                                <a href="#">{{ __('main.Translate_Edit') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('language.translate.update', encrypt($language->id)) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                @include('include.message')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('main.Translate') }} {{ $language->name }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row allItems">
                                @foreach ($data as $key => $value)
                                    <div class="col-md-3 mb-3">
                                        <label>{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                        <input type="text" class="form-control" name="{{ $key }}"
                                            value="{{ $value }}" placeholder="{{ __('main.Title') }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
