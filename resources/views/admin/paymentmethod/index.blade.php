@extends('layouts.main')
@section('title', __('main.Payment_Method_Settings'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-6">
                    <div class="page-header-title">
                        <i class="ik ik-dollar-sign bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('main.Payment_Method') }}</h5>
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
                                <a href="#">{{ __('main.Payment_Method') }}</a>
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
                        <h3>{{ __('main.Payment_Method_Settings') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __('main.Payment_Method_Settings') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="forms-sample" action="{{ route('paymentmethod.update') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="PAYPAL_BASE_URI">{{ __('main.Paypal_Base_Uri') }}</label>
                                                        <input name="PAYPAL_BASE_URI" type="text"
                                                            value="{{ !empty($pms) ? $pms->PAYPAL_BASE_URI : '' }}"
                                                            class="form-control" id="PAYPAL_BASE_URI"
                                                            placeholder="{{ __('main.Paypal_Base_Uri') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('PAYPAL_BASE_URI')) }}</span>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="PAYPAL_CLIENT_ID">{{ __('main.Paypal_Client_Id') }}</label>
                                                        <input name="PAYPAL_CLIENT_ID" type="text"
                                                            value="{{ !empty($pms) ? $pms->PAYPAL_CLIENT_ID : '' }}"
                                                            class="form-control" id="PAYPAL_CLIENT_ID"
                                                            placeholder="{{ __('main.Paypal_Client_Id') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('PAYPAL_CLIENT_ID')) }}</span>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="PAYPAL_CLIENT_SECRET">{{ __('main.Paypal_Client_Secret') }}</label>
                                                        <input name="PAYPAL_CLIENT_SECRET" type="text"
                                                            value="{{ !empty($pms) ? $pms->PAYPAL_CLIENT_SECRET : '' }}"
                                                            class="form-control" id="PAYPAL_CLIENT_SECRET"
                                                            placeholder="{{ __('main.Paypal_Client_Id') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('PAYPAL_CLIENT_SECRET')) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="PAYPAL_STATUS">{{ __('main.Paypal_Status') }}</label>
                                                        <select name="PAYPAL_STATUS" id="PAYPAL_STATUS"
                                                            class="form-control">
                                                            <option value="1"
                                                                {{ env('PAYPAL_STATUS') == '1' ? 'selected' : '' }}>
                                                                {{ __('main.Active') }}</option>
                                                            <option value="0"
                                                                {{ env('PAYPAL_STATUS') == '0' ? 'selected' : '' }}>
                                                                {{ __('main.Inactive') }}</option>
                                                        </select>
                                                        <span
                                                            class="text-danger">{{ __($errors->first('PAYPAL_STATUS')) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">

                                                    <div class="form-group">
                                                        <label for="STRIPE_KEY">{{ __('main.Stripe_key') }}</label>
                                                        <input name="STRIPE_KEY" type="text"
                                                            value="{{ !empty($pms) ? $pms->STRIPE_KEY : '' }}"
                                                            class="form-control" id="STRIPE_KEY"
                                                            placeholder="{{ __('main.Stripe_key') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('STRIPE_KEY')) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="STRIPE_SECRET">{{ __('main.Stripe_Secret') }}</label>
                                                        <input name="STRIPE_SECRET" type="text"
                                                            value="{{ !empty($pms) ? $pms->STRIPE_SECRET : '' }}"
                                                            class="form-control" id="STRIPE_SECRET"
                                                            placeholder="{{ __('main.Stripe_Secret') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('STRIPE_SECRET')) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="STRIPE_STATUS">{{ __('main.Stripe_Status') }}</label>
                                                        <select name="STRIPE_STATUS" id="STRIPE_STATUS"
                                                            class="form-control">
                                                            <option value="1"
                                                                {{ env('STRIPE_STATUS') == '1' ? 'selected' : '' }}>
                                                                {{ __('main.Active') }}</option>
                                                            <option value="0"
                                                                {{ env('STRIPE_STATUS') == '0' ? 'selected' : '' }}>
                                                                {{ __('main.Inactive') }}</option>
                                                        </select>
                                                        <span
                                                            class="text-danger">{{ __($errors->first('STRIPE_STATUS')) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="sslcz_store_id">{{ __('main.Sslcommerz_Store_Id') }}</label>
                                                        <input type="text" name="sslcz_store_id" class="form-control"
                                                            value="{{ env('SSLCZ_STORE_ID') }}"
                                                            placeholder="{{ __('main.Sslcommerz Store Id') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('sslcz_store_id')) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="sslcz_store_password">{{ __('main.Sslcommerz_Store_Password') }}</label>
                                                        <input type="text" name="sslcz_store_password"
                                                            class="form-control"
                                                            value="{{ env('SSLCZ_STORE_PASSWORD') }}"
                                                            placeholder="{{ __('main.Sslcommerz Store Password') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('sslcz_store_password')) }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="sslcz_status">{{ __('main.Sslcommerz_Status') }}</label>
                                                        <select name="sslcz_status" id="sslcz_status"
                                                            class="form-control">
                                                            <option value="1"
                                                                {{ env('SSLCZ_STATUS') == '1' ? 'selected' : '' }}>
                                                                {{ __('main.Active') }}</option>
                                                            <option value="0"
                                                                {{ env('SSLCZ_STATUS') == '0' ? 'selected' : '' }}>
                                                                {{ __('main.Inactive') }}</option>
                                                        </select>
                                                        <span
                                                            class="text-danger">{{ __($errors->first('sslcz_status')) }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="bank_name">{{ __('main.Bank_Name') }}</label>
                                                        <input type="text" name="bank_name" class="form-control"
                                                            value="{{ env('BANK_NAME') }}"
                                                            placeholder="{{ __('main.Bank Name') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('bank_name')) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="bank_account_name">{{ __('main.Bank_Account_Name') }}</label>
                                                        <input type="text" name="bank_account_name"
                                                            class="form-control" value="{{ env('BANK_ACCOUNT_NAME') }}"
                                                            placeholder="{{ __('main.Bank_Account_Name') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('bank_account_name')) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="bank_account_number">{{ __('main.Bank_Account_Number') }}</label>
                                                        <input type="text" name="bank_account_number"
                                                            class="form-control" value="{{ env('BANK_ACCOUNT_NUMBER') }}"
                                                            placeholder="{{ __('main.Bank_Account_Number') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('bank_account_number')) }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="bank_branch">{{ __('main.Bank_Branch') }}</label>
                                                        <input type="text" name="bank_branch" class="form-control"
                                                            value="{{ env('BANK_BRANCH') }}"
                                                            placeholder="{{ __('main.Bank_Branch') }}">
                                                        <span
                                                            class="text-danger">{{ __($errors->first('bank_branch')) }}</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="bank_status">{{ __('main.Bank_Status') }}</label>
                                                        <select name="bank_status" id="bank_status" class="form-control">
                                                            <option value="1"
                                                                {{ env('BANK_STATUS') == '1' ? 'selected' : '' }}>
                                                                {{ __('main.Active') }}</option>
                                                            <option value="0"
                                                                {{ env('BANK_STATUS') == '0' ? 'selected' : '' }}>
                                                                {{ __('main.Inactive') }}</option>
                                                        </select>
                                                        <span
                                                            class="text-danger">{{ __($errors->first('bank_status')) }}</span>
                                                    </div>
                                                </div>

                                            </div>



                                            <button type="submit"
                                                class="btn btn-primary mr-2">{{ __('main.Update') }}</button>
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
