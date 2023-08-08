@extends('layouts.main')
@section('title', __('Menu Create'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Menu')}}</h5>
                            <span>{{ __('Add new menu')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Menu')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Create')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="image-group">
                                <div class="form-group">
                                    <label for="">{{ __('Label')}} <span class="text-danger">*</span> </label> <br>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="label"  class="form-control" placeholder="{{ __('Menu label') }}">
                                        <div class="input-group-append">
                                            <select class="form-control wh-90-45 cus-w90-h45" name="status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="2">{{ __('Draft') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{ __($errors->first('label')) . ' ' . __($errors->first('status')) }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection