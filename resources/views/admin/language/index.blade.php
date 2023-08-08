@extends('layouts.main')
@section('title', __('main.Languages'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Languages') }}</h5>
                            <span>{{ __('main.Languages_List') }}</span>
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
                                <a href="#">{{ __('main.Languages_List') }}</a>
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
                        <h3>{{ __('main.Language_Create') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @can('language-create')
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('language.store') }}">
                                                @csrf
                                                <div class="custome-form">
                                                    <p class="col-form-label"><b>{{ __('main.Language_Create') }}</b></p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="start_time">{{ __('main.Name') }}</label>
                                                                <input name="name" type="text" required
                                                                    placeholder="{{ __('main.Name') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="end_time">{{ __('main.Prefix') }}</label>
                                                                <input name="prefix" type="text" required
                                                                    placeholder="{{ __('main.Prefix') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="end_time">{{ __('main.Direction') }} </label>
                                                                <select name="direction" id="direction" required>
                                                                    <option value="ltr">{{ __('main.LTR') }}</option>
                                                                    <option value="rtl">{{ __('main.RTL') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('main.Add') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ __('main.Languages_List') }}</p>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($all_languages->count() > 0)
                                                    @foreach ($all_languages as $lang)
                                                        <tr>
                                                            <td>{{ $lang->name }}</td>
                                                            <td>
                                                                <div class="text-right">

                                                                    <a href="{{ route('language.edit', encrypt($lang->id)) }}"
                                                                        class="btn btn-primary">{{ __('main.Edit') }}</a>
                                                                    <a href="{{ route('language.translate', encrypt($lang->id)) }}"
                                                                        class="btn btn-info">{{ __('main.Translate') }}</a>
                                                                    <a href="{{ route('language.delete', encrypt($lang->id)) }}"
                                                                        class="btn btn-danger delete">{{ __('main.Delete') }}</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
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
