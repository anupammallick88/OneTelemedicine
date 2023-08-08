@extends('layouts.main')
@section('title', __('Currency Edit'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit Currency') }}</h5>
                            <span>{{ __('Edit Currency') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('currency.index') }}">{{ __('Currency') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="{{ route('currency.update', $currency->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="row">
                @include('include.message')
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Currency Edit') }}</h3>
                            <a class="btn btn-primary ml-auto"
                                href="{{ route('currency.index') }}">{{ __('List') }}</a>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">{{ __('Currency Code') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="currency_code"
                                    value="{{ $currency->currency_code }}" placeholder="{{ __('Currency Code') }}">
                                <span class="text-danger">{{ __($errors->first('currency_code')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="title">{{ __('Symbol') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="symbol"
                                    value="{{ $currency->symbol }}" placeholder="{{ __('Symbol') }}">
                                <span class="text-danger">{{ __($errors->first('symbol')) }}</span>
                            </div>
                            <div class="form-group">
                                <label for="currency_placement">{{ __('Currency Placement') }}</label>
                                <select name="currency_placement" id="currency_placement" class="form-control">
                                    <option value="">--Select Option--</option>
                                    <option value="before"
                                        {{ $currency->currency_placement == 'before' ? 'selected' : '' }}>
                                        Before Amount</option>
                                    <option value="after"
                                        {{ $currency->currency_placement == 'after' ? 'selected' : '' }}>
                                        After Amount</option>
                                </select>
                                @error('currency_placement')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
