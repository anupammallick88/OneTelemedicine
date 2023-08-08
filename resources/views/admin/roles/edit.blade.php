@extends('layouts.main')
@section('title', __('main.Role_Edit'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Role') }}</h5>
                            <span>{{ __('main.Role_Edit') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('main.Roles') }}</a>
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
                        <h3>{{ __('main.Role_Edit') }}</h3>
                        <a class="btn btn-primary ml-auto" href="{{ route('admin.role.index') }}">{{ __('main.List') }}</a>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" action="{{ route('admin.role.update', $role->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('main.Name') }}</label>
                                        <input name="name" type="text" class="form-control" id="name"
                                            value="{{ $role->name }}" placeholder="{{ __('main.Name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($permission as $value)
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input name="permission[]" value="{{ $value->id }}" type="checkbox"
                                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                            {{ ucwords(implode(' ', explode('-', $value->name))) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-5">{{ __('main.Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
