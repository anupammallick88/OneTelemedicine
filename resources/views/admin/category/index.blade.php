@extends('layouts.main')
@section('title', __('main.Categories'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Categories') }}</h5>
                            <span>{{ __('main.Categories_List') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ __('main.Category') }}</a>
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
                        <h3>{{ __('main.Categories_List') }}</h3>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{ $dataTable->scripts() }}
@endpush
