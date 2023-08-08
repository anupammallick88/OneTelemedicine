<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <title>{{ __('Prescription') }}</title>    
</head>

<body id="print">
    <!-- <div class="appointments-modal modal fade main-pdf" id="appointmentsModal{{ $app->id }}" tabindex="-1"
        aria-labelledby="appointmentsModal{{ $app->id }}" aria-hidden="true">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h2>{{ $app->doctor->user->name }}</h2>
                    <h4>{{ $app->doctor->degree }}</h4>
                </div>
                <div class="col-sm">

                </div>
            </div>           
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="appointments-wrap">
                                    <div class="appointments-header">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="appointments-header-left d-flex">
                                                    <table class="cus-pdf-w100">
                                                        <tr>
                                                            <td>
                                                                <h2>{{ $app->doctor->user->name }}</h2>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $app->doctor->degree }}</td>
                                                            <td>testname</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $app->doctor->specialist }}</td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="appointments-header-right">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="appointments-date">
                                        <p>
                                            {{ __('Appointment Date:') }}
                                            {{ Carbon\Carbon::parse($app->booking_date)->format('d M, Y') }},
                                            {{ Carbon\Carbon::parse($app->booking_date)->format('l') }},
                                            {{ $app->booking_time }}
                                        </p>
                                    </div>
                                    <div class="appointments-body" id="medicine_table">
                                        <div class="medicine-info">
                                            <h3 class="appointments-section-title">{{ __('Medicine:') }}</h3>
                                            <div class="primary-table">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('Medicine Name') }}</th>
                                                                <th scope="col">{{ __('Type') }}</th>
                                                                <th scope="col">{{ __('Mg/Ml') }}</th>
                                                                <th scope="col">{{ __('Dose') }}</th>
                                                                <th scope="col">{{ __('Day') }}</th>
                                                                <th scope="col">{{ __('Comments') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($app->prescription as $key => $prescription)
                                                                @if (is_array(json_decode($prescription->medicine_name, true)))
                                                                    @php
                                                                        $type = json_decode($prescription->medicine_type, true);
                                                                        $quantity = json_decode($prescription->medicine_quantity, true);
                                                                        $dose = json_decode($prescription->medicine_dose, true);
                                                                        $day = json_decode($prescription->medicine_day, true);
                                                                        $comment = json_decode($prescription->medicine_comment, true);
                                                                    @endphp
                                                                    @foreach (json_decode($prescription->medicine_name, true) as $key1 => $medicine)
                                                                        <tr>
                                                                            <td>{{ $medicine }}</td>
                                                                            <td>{{ $type[$key1] }}</td>
                                                                            <td>{{ $quantity[$key1] }}</td>
                                                                            <td>{{ $dose[$key1] }}</td>
                                                                            <td>{{ $day[$key1] }}</td>
                                                                            <td>{{ $comment[$key1] }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 ">
                                                <div class="patient-info">
                                                    <h3 class="appointments-section-title mb-2">
                                                        {{ __('Patient Info:') }}</h3>
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ __('Name') }} </td>
                                                                <td>: <b>{{ $app->patient->name }}</b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="test-repot mb-4">
                                                    <h3 class="appointments-section-title mb-3">{{ __('Test') }}
                                                    </h3>
                                                    <ul>
                                                        @foreach ($app->testprescription as $prescription)
                                                            <li>{{ $prescription->test_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="advice-list-area">
                                                    <h3 class="appointments-section-title mb-3">{{ __('Advice') }}
                                                    </h3>
                                                    <ul>
                                                        @foreach ($app->prescription as $prescriptionadvice)
                                                            <li>{{ $prescriptionadvice->advice }}</li>
                                                        @endforeach
                                                    </ul>
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
        </div>
    </div> -->
    <div class="container">
        <div class="row">            
            <div class="col-6 bod" style="border-right: 1.2px solid #8c8b8b;">
                <h3>{{ Str::of($app->doctor->user->name)->limit(110)->upper() }}</h3>
                <h4 style="font-size: 1rem; text-decoration: underline;">{{ Str::of($app->doctor->specialist)->limit(110)->upper() }}</h4>
                <h5 style="font-size: 0.4rem; text-decoration: underline;">{{ $app->doctor->degree }}</h4>                
            </div>
            <div class="col-6">
                <p style="margin-bottom: 0.1rem !important;">{{ __('Time:') }} {{ $app->doctor->starttime }}-{{$app->doctor->endtime}}, {{ $app->doctor->starttime2 }}-{{$app->doctor->endtime2}}</p>
                <p style="margin-bottom: 0.1rem !important;">{{ __('Day Off:') }} {{ $app->doctor->offday }}</p>
                <p style="margin-bottom: 0.1rem !important;">{{ __('Chamber:') }} {{ $app->doctor->chamber }}</p>                
            </div>
            <div class="col-12"><hr class="style1" style="border-top: 2px solid #8c8b8b;"></div>                 
            
        </div>
        <div class="row">
            <div class="col-6">
                <p style="margin-bottom: 0.1rem !important;">
                    {{ __('Patient Name:') }}
                    {{ $app->patient->name }}
                </p>
                <p style="margin-bottom: 0.1rem !important;">
                    {{ __('Age/Sex:') }}
                    {{ $app->patient->age }}/{{ $app->patient->gender }}
                </p>
                <p style="margin-bottom: 0.1rem !important;">
                    {{ __('Appointment ID:') }}
                    {{ $app->id }}
                </p>         
            </div>
            <div class="col-6">
                <div class="appointments-date" style="text-align: right;">
                    <p style="margin-bottom: 0.1rem !important;">
                        {{ __('Appointment Date:') }}
                        {{ Carbon\Carbon::parse($app->booking_date)->format('d M, Y') }},
                        {{ Carbon\Carbon::parse($app->booking_date)->format('l') }},
                        {{ $app->booking_time }}
                    </p>
                    <p style="margin-bottom: 0.1rem !important;">
                        {{ __('Mobile:') }}
                        {{ $app->patient->mobile }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="test-repot mb-4">
                    <h5 class="appointments-section-title mb-3">{{ __('Vitals') }} :</h5>
                    <p style="margin-bottom: 0.1rem !important;">
                        {{ __('Weight:') }}
                        @foreach ($app->prescription as $prescription)
                            {{ $prescription->patient_weight }}
                        @endforeach
                        
                    </p>
                    <p style="margin-bottom: 0.1rem !important;">
                        {{ __('Pulse:') }}
                        @foreach ($app->prescription as $prescription)
                            {{ $prescription->patient_temperature }}
                        @endforeach                        
                    </p>
                    <p style="margin-bottom: 0.1rem !important;">
                        {{ __('BP:') }}
                        @foreach ($app->prescription as $prescription)
                            {{ $prescription->patient_bp }}
                        @endforeach                        
                    </p>                    
                </div>
            </div>
            <div class="col-8">
            <div class="medicine-info">
                <h5 class="appointments-section-title">{{ __('Medicine:') }}</h5>
                    <div class="primary-table">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Medicine Name') }}</th>
                                        <th scope="col">{{ __('Type') }}</th>
                                        <th scope="col">{{ __('Mg/Ml') }}</th>
                                        <th scope="col">{{ __('Dose') }}</th>
                                        <th scope="col">{{ __('Day') }}</th>
                                        <th scope="col">{{ __('Comments') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($app->prescription as $key => $prescription)
                                        @if (is_array(json_decode($prescription->medicine_name, true)))
                                            @php
                                                $type = json_decode($prescription->medicine_type, true);
                                                $quantity = json_decode($prescription->medicine_quantity, true);
                                                $dose = json_decode($prescription->medicine_dose, true);
                                                $day = json_decode($prescription->medicine_day, true);
                                                $comment = json_decode($prescription->medicine_comment, true);
                                            @endphp
                                            @foreach (json_decode($prescription->medicine_name, true) as $key1 => $medicine)
                                                <tr>
                                                    <td>{{ $medicine }}</td>
                                                    <td>{{ $type[$key1] }}</td>
                                                    <td>{{ $quantity[$key1] }}</td>
                                                    <td>{{ $dose[$key1] }}</td>
                                                    <td>{{ $day[$key1] }}</td>
                                                    <td>{{ $comment[$key1] }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="test-repot mb-4">
                    <h5 class="appointments-section-title mb-3">{{ __('Advised Investigations') }} :</h5>
                    <ul>
                        @foreach ($app->testprescription as $prescription)
                            <li>{{ $prescription->test_name }}</li>
                        @endforeach
                    </ul>
                </div>                
            </div>
            <div class="advice-list-area">
                <h5 class="appointments-section-title mb-3">{{ __('Instructions') }} :</h5>
                <ul>
                    @foreach ($app->prescription as $prescriptionadvice)
                        <li>{{ $prescriptionadvice->advice }}</li>
                    @endforeach
                </ul>
            </div>            
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>
