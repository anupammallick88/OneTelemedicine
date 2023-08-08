@extends('layouts.main')
@section('title', __('Mail'))
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-6">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Subscriber')}}</h5>
                        <span>{{ __('Send Mail to All the Subscribers')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('subscribers.index') }}">{{ __('Subscriber')}}</a>
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
                    <h3>{{ __('Subscriber')}}</h3>
                </div>
                <div class="card-header">
                    <h3>{{ __('Subscriber Mail')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('subscribers.mailsent')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="input">{{ __('Subject')}} <span class="text-danger">*</span></label> <br>
                            <input type="text" id="tags" name="subject" class="form-control">
                            <br>
                            <span class="text-danger">{{ __($errors->first('subject')) }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Mail') }} <span class="text-danger">*</span></label>
                            <textarea id="description" name="email" class="form-control" rows="5"></textarea>
                            <span class="text-danger">{{ __($errors->first('email')) }}</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection