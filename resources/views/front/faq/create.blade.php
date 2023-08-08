@extends('layouts.main')
@section('title', __('main.Faq_Create'))
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Faq') }}</h5>
                            <span>{{ __('main.Faq_Create') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('main.Faq') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('faq.store') }}" method="POST">
            @csrf
            <div class="row">
                @include('include.message')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach (allLanguages() as $lang)
                                <div class="form-group">
                                    <label for="ques">{{ __('main.Question') }} ({{ $lang->name }})</label>
                                    <textarea class="form-control" id="ques" name="question_{{ $lang->prefix }}" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ans">{{ __('main.Answer') }} ({{ $lang->name }})</label>
                                    <textarea class="form-control" id="ans" name="answer_{{ $lang->prefix }}" rows="4"></textarea>
                                </div>
                                <hr />
                            @endforeach
                            <div class="form-group">
                                <label for="">{{ __('main.Faq Title') }} <span class="text-danger">*</span>
                                </label>
                                <select class="form-control select2" name="type">
                                    <option value="1">{{ __('main.Basic_Questions') }}</option>
                                    <option value="2">{{ __('main.Medical_Questions') }}</option>
                                    <option value="3">{{ __('main.Pricing_Plan') }}</option>
                                    <option value="4">{{ __('main.Other_Questions') }}</option>
                                </select>
                                <span class="text-danger">{{ __($errors->first('type')) }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('main.Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/select2-active.js') }}"></script>
    @endpush
@endsection
