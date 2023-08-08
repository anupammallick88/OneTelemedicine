@extends('layouts.main')
@section('title', __('main.Zoom_Settings'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-sites bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Zoom_Settings') }}</h5>
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
                                <a href="#">{{ __('main.Zoom_Settings') }}</a>
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
                        <h3>{{ __('main.Zoom_Settings') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __('main.Zoom_Elements') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{ route('zoom.setting.update') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="ZOOM_API_KEY">{{ __('main.ZOOM_API_KEY') }}</label>
                                                <input name="ZOOM_API_KEY" type="text" value="{{ env('ZOOM_API_KEY') }}"
                                                    class="form-control" id="ZOOM_API_KEY"
                                                    placeholder="{{ __('main.ZOOM_API_KEY') }}">
                                                <span class="text-danger">{{ __($errors->first('ZOOM_API_KEY')) }}</span>
                                            </div>

                                            <div class="form-group">
                                                <label for="ZOOM_API_SECRET">{{ __('main.ZOOM_API_SECRET') }}</label>
                                                <input name="ZOOM_API_SECRET" type="text"
                                                    value="{{ env('ZOOM_API_SECRET') }}" class="form-control"
                                                    id="ZOOM_API_SECRET" placeholder="{{ __('main.ZOOM_API_SECRET') }}">
                                                <span
                                                    class="text-danger">{{ __($errors->first('ZOOM_API_SECRET')) }}</span>
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
