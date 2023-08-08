@extends('front.layouts.main')
@section('page_title', __('Quick Appointment'))
@section('content')
    <!-- breadcrumb area start here   -->
    <section class="breadcrumb-area cus-bg-img"
        style="background-image: url({{ asset(path_page_banner() . $allsettings['banner']) }})">
        <div class="container">
            <h2 class="page-title">{{ __('Quick Appointment') }}</h2>
            <ul class="breadcrumb-page">
                <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Appointment') }}</li>
            </ul>
        </div>
    </section>
    <!-- breadcrumb area end here   -->
    <div class="main-section-wrap section" id="js_variable_data" data-jsvar='{{ $redirectPatientVariables }}'>
        <div class="container">

            @if ($doctorselected->offday)
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>

                <div class="alert alert-primary d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                        <use xlink:href="#info-fill" />
                    </svg>
                    <div class="ml-3">
                        @php
                            $dayofflist = explode(',', $doctorselected->offday);
                        @endphp
                        <span class="font-weight-bold">Day Off : </span>
                        @foreach ($dayofflist as $key => $off)
                            @if ($off == 'sun')
                                <span class="font-weight-bold">Sunday</span>
                            @elseif ($off == 'mon')
                                <span class="font-weight-bold">Monday</span>
                            @elseif ($off == 'tue')
                                <span class="font-weight-bold">Tuesday</span>
                            @elseif ($off == 'wed')
                                <span class="font-weight-bold">Wednesday</span>
                            @elseif ($off == 'thu')
                                <span class="font-weight-bold">Thursday</span>
                            @elseif ($off == 'fri')
                                <span class="font-weight-bold">Friday</span>
                            @elseif ($off == 'sat')
                                <span class="font-weight-bold">Saturday</span>
                            @endif
                            @if (count($dayofflist) - 1 > $key)
                                <span>|</span>
                            @endif
                        @endforeach
                    </div>
                </div>

            @endif

            <div class="section-wraper" id="cong" class="small-cong">
                <div class="tab-content" id="DashboardTabContent">
                    <div class="tab-pane fade show active" id="tabthree" role="tabpanel" aria-labelledby="tabthree-tab">
                        <div class="new-appointment-form">
                            <form id="new-appointment-form" method="POST" action="{{ route('appointment') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="doctor_get_fees" id="doctor_get_fees">
                                <!-- Circles which indicates the steps of the form: -->
                                <div class="form-progres-step small-cong">
                                    <div class="step"><span>{{ __('01') }}</span></div>
                                    <div class="step"><span>{{ __('02') }}</span></div>
                                    <div class="step"><span>{{ __('03') }}</span></div>
                                </div>
                                <!-- One "tab" for each step in the form: -->
                                <input type="hidden" name="slot_id" id="slotid">
                                <input type="hidden" id="appinput" value="" name="appinput">
                                <span data-id="{{ route('patient.set_payment_type') }}" id="payment_type_route"></span>
                                <span data-day="{{ $doctorselected->offday }}" id="offday"></span>
                                <div class="tab">
                                    <h4 class="form-inner-title">{{ __('Select Service & Date') }}</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="date" name="appdate" class="form-control" id="date"
                                                    min="{{ date('Y-m-d') }}" placeholder="{{ __('Select Date') }}" />
                                                <span class="form-icon"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="apptime-select">
                                                <i class="fas fa-chevron-down"></i>
                                                <select name="apptime" id="apptime" required>
                                                    <option value="">{{ __('Select time slot') }}</option>
                                                    @foreach ($docslots as $docslot)
                                                        <option value="{{ $docslot->id }}"
                                                            data-time="{{ $docslot->start_time }}-{{ $docslot->end_time }}">
                                                            {{ Carbon\Carbon::parse($docslot->start_time)->format('h:i A') }}-
                                                            {{ Carbon\Carbon::parse($docslot->end_time)->format('h:i A') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-inner-title">{{ __('Appointment Type') }} </h4>
                                    <div class="dectors-service-list">
                                        <div class="form-check">
                                            <input class="form-check-input payment_type" type="radio" name="payment_type"
                                                id="online" value="online" required>
                                            <label class="form-check-label" for="online">
                                                {{ __('Online') }}
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input payment_type" type="radio"
                                                name="payment_type" id="offline" value="offline" required>
                                            <label class="form-check-label" for="offline">
                                                {{ __('Offline') }}
                                            </label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="selectdoctory" value="{{ $doctorselected->id }}">
                                    <input type="hidden" name="slot_id" value="">
                                    <input type="hidden" id="paypaldocservice" name="DoctorsService"
                                        value="{{ $doctorselected->category->name }}">
                                </div>
                                <div class="tab">
                                    {{-- <h3 class="form-title">{{ __('Check Information Place Comment') }}</h3> --}}
                                    <h4 class="form-inner-title"></h4>
                                    <div class="appoinment-table mb-30">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ __('Appointment Date') }}</td>
                                                        <td>{{ __('Appointment Time') }}</td>
                                                        <td>{{ __('Appointment Day') }}</td>
                                                        <td>{{ __('Consultancy Fee') }} </td>
                                                        <td>{{ __('Services') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td id="app_date"></td>
                                                        <td id="app_time"></td>
                                                        <td id="app_day"></td>
                                                        <td id="app_fees"></td>
                                                        <td id="app_specialist"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Comment">{{ __('Comment') }}</label>
                                        <textarea name="comment" class="form-control comment-box" id="Comment" rows="3"
                                            placeholder="{{ __('Comment') }} "></textarea>
                                    </div>
                                </div>
                                <div class="tab">
                                    <h3 class="form-title">{{ __('Select Payment method') }}</h3>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <div class="form-group" id="toggler">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-btn">
                                    <button type="button" id="prevBtn">{{ __('Previous') }}</button>
                                    <button type="button" id="nextBtn">{{ __('Next') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="congratulation-wrap d-none">
                    <div class="congratulation-box text-center">
                        <img class="congratulation-img" src="{{ asset('front/assets/images/congratulation.png') }}"
                            alt="{{ __('congratulation') }}" />
                        <h3 class="congratulation-title">{{ __('Congratulation') }}</h3>
                        <p class="congratulation-text">
                            {{ __('Your Booking has been Pending Wait For Doctor Approval') }}</p>
                        <a id="closebtn" class="close-btn">{{ __('Close') }}</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- paypal form -->
    <form id="paypalform" action="{{ route('pay') }}" method="POST">
        @csrf
        <input type="hidden" name="selectdoctory" id="paypal_docid" value='{{ $doctorselected->id }}'>
        <input type="hidden" name="appinput" id="paypal_appinput" value=''>
        <input type="hidden" name="slot_id" id="paypal_slotid" value=''>
        <input type="hidden" name="comment" id="paypal_comment" value=''>
        <input type="hidden" name="paymentmethod" value='paypal'>
        <input type="hidden" name="doctorsService" id="paypal_doctorservice" value=''>
        <input type="hidden" name="appdate" id="paypal_appdate" value=''>
        <input type="hidden" name="apptime" id="paypal_apptime" value=''>
        <input id="paypalvalue" name="value" type="hidden" value="">
        <input name="currency" type="hidden" value="usd">
        <input name="payment_platform" type="hidden" value="1">
        <input name="payment_type" id="payment_type_paypal" type="hidden" value="online">
        <input name="appointment_type" id="appointment_type" type="hidden" value="{{ ONLINE }}">
    </form>
    <!-- paypal form -->
@endsection
@push('script')
    <script src="{{ asset('front/js/redirect-patient.js') }}"></script>
@endpush
