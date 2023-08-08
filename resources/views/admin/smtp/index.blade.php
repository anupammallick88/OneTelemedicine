@extends('layouts.main')
@section('title', __('main.SMTP_Settings'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-sites bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.SMTP_Settings') }}</h5>
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
                                <a href="#">{{ __('main.SMTP_Settings') }}</a>
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
                        <h3>{{ __('main.SMTP_Settings') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __('main.SMTP_Elements') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{ route('smtp.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Mail_Driver') }}</label>
                                                <input name="MAIL_MAILER" type="text"
                                                    value="{{ !empty($smtp) ? $smtp->MAIL_MAILER : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Mail_Driver') }}">
                                                <span class="text-danger">{{ __($errors->first('MAIL_MAILER')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Mail Host') }}</label>
                                                <input name="MAIL_HOST" type="text"
                                                    value="{{ !empty($smtp) ? $smtp->MAIL_HOST : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Mail_Host') }}">
                                                <span class="text-danger">{{ __($errors->first('MAIL_HOST')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Mail_Port') }}</label>
                                                <input name="MAIL_PORT" type="text"
                                                    value="{{ !empty($smtp) ? $smtp->MAIL_PORT : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Mail_Port') }}">
                                                <span class="text-danger">{{ __($errors->first('MAIL_PORT')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Mail_Username') }}</label>
                                                <input name="MAIL_USERNAME" type="text"
                                                    value="{{ !empty($smtp) ? $smtp->MAIL_USERNAME : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Mail_Username') }}">
                                                <span class="text-danger">{{ __($errors->first('MAIL_USERNAME')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Mail_Password') }}</label>
                                                <input name="MAIL_PASSWORD" type="text"
                                                    value="{{ !empty($smtp) ? $smtp->MAIL_PASSWORD : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Mail_Password') }}">
                                                <span class="text-danger">{{ __($errors->first('MAIL_PASSWORD')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Mail_Encryption') }}</label>
                                                <input name="MAIL_ENCRYPTION" type="text"
                                                    value="{{ !empty($smtp) ? $smtp->MAIL_ENCRYPTION : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Mail_Encryption') }}">
                                                <span
                                                    class="text-danger">{{ __($errors->first('MAIL_ENCRYPTION')) }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{ __('main.Mail_From_Address') }}</label>
                                                <input name="MAIL_FROM_ADDRESS" type="text"
                                                    value="{{ !empty($smtp) ? $smtp->MAIL_FROM_ADDRESS : '' }}"
                                                    class="form-control" id="exampleInputName1"
                                                    placeholder="{{ __('main.Mail_From_Address') }}">
                                                <span
                                                    class="text-danger">{{ __($errors->first('MAIL_FROM_ADDRESS')) }}</span>
                                            </div>
                                            <br>
                                            <br>
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
