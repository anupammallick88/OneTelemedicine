@extends('layouts.main')
@section('title', __('main.Faq'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Faq') }}</h5>
                            <span>{{ __('main.Faq_List') }}</span>
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
                                <a href="#">{{ __('main.Faq') }}</a>
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
                        <h3>{{ __('main.Faq_List') }}</h3>
                        @can('faq-create')
                            <a class="btn btn-primary ml-auto" href="{{ route('faq.create') }}">{{ __('main.Add_Faq') }}</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Section -->
        <form action="{{ route('section.title.store', 'faq-section') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('main.Faq_Section') }}</h3>
                        </div>
                        <div class="card-body">
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="title">{{ __('main.Title') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title"
                                        name="title_{{ $lang->prefix }}" placeholder="{{ __('main.Title') }}"
                                        value="{{ section_title('faq-section') ? section_title('faq-section')->translateOrDefault($lang->prefix)->title : '' }}">
                                    <span class="text-danger">{{ __($errors->first('title')) }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('main.Description') }} ({{ $lang->name }})<span
                                            class="text-danger">*</span></label>
                                    <textarea id="description" name="description_{{ $lang->prefix }}" class="form-control" rows="5">{{ section_title('faq-section') ? section_title('faq-section')->translateOrDefault($lang->prefix)->description : '' }}</textarea>
                                    <span class="text-danger">{{ __($errors->first('description')) }}</span>
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
@push('script')
    {{ $dataTable->scripts() }}
@endpush
