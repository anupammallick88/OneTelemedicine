@extends('layouts.main')
@section('title', __('main.Patient_Create'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Patients') }}</h5>
                            <span>{{ __('main.Patient_Create') }}</span>
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
                                <a href="#">{{ __('main.Patient') }}</a>
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
                        <h3>{{ __('main.Patient_Create') }}</h3>
                        @can('patient-list')
                            <a class="btn btn-primary ml-auto"
                                href="{{ route('patient.index') }}">{{ __('main.List') }}</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('patient.store') }}">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="first_name"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.First_name') }}</label>
                                                <div class="col-md-6">
                                                    <input id="first_name" type="text"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        name="first_name" value="{{ old('first_name') }}"
                                                        autocomplete="name" autofocus>
                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="last_name"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Last_Name') }}</label>
                                                <div class="col-md-6">
                                                    <input id="last_name" type="text"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        name="last_name" value="{{ old('last_name') }}"
                                                        autocomplete="name" autofocus>
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.E-Mail_Address') }}</label>
                                                <div class="col-md-6">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" autocomplete="email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="docat"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Gender') }}</label>
                                                <div class="col-md-6">
                                                    <select class="form-select form-control" name="gender">
                                                        <option value="male">{{ __('main.Male') }}</option>
                                                        <option value="female">{{ __('main.Female') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Password') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" autocomplete="new-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password-confirm"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Confirm_Password') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                        name="password_confirmation" autocomplete="new-password">
                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="birthday"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Birthday') }}</label>
                                                <div class="col-md-6">
                                                    <input id="birthday" type="date"
                                                        class="form-control @error('birthday') is-invalid @enderror"
                                                        name="birthday" value="{{ old('birthday') }}"
                                                        autocomplete="birthday" autofocus>
                                                    @error('birthday')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="degree"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Qualification_') }}</label>
                                                <div class="col-md-6">
                                                    <input id="degree" type="text"
                                                        class="form-control @error('degree') is-invalid @enderror"
                                                        name="degree" value="{{ old('degree') }}"
                                                        autocomplete="degree" autofocus>
                                                    @error('degree')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="mobile"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Mobile') }}</label>
                                                <div class="col-md-6">
                                                    <input id="mobile" type="text"
                                                        class="form-control @error('mobile') is-invalid @enderror"
                                                        name="mobile" value="{{ old('mobile') }}"
                                                        autocomplete="mobile" autofocus>
                                                    @error('mobile')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="address"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.Address_') }}</label>
                                                <div class="col-md-6">
                                                    <input id="address" type="text"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        name="address" value="{{ old('address') }}"
                                                        autocomplete="address" autofocus>
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="city"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('main.City_') }}</label>
                                                <div class="col-md-6">
                                                    <input id="city" type="text"
                                                        class="form-control @error('city') is-invalid @enderror"
                                                        name="city" value="{{ old('city') }}"
                                                        autocomplete="city" autofocus>
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ __($message) }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('main.Register') }}
                                                    </button>
                                                </div>
                                            </div>
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
