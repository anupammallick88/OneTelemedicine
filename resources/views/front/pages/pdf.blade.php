<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Prescription') }}</title>
</head>

<body>
    <div class="appointments-modal modal fade main-pdf" id="appointmentsModal{{ $app->id }}" tabindex="-1"
        aria-labelledby="appointmentsModal{{ $app->id }}" aria-hidden="true">
        <div class="container">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="appointments-wrap">
                                    <div class="appointments-header">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6" style="width:50%; display:inline-block;">
                                                <div class="appointments-header-left d-flex">
                                                    <table class="cus-pdf-w100">
                                                        <tr>
                                                            <td>
                                                                <h2>{{ $app->doctor->user->name }}</h2>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $app->doctor->degree }}</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ $app->doctor->specialist }}</td>
                                                            <td></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6" style="width:50%; display:inline-block;">
                                                <div class="appointments-header-right">
                                                <div class="appointments-date">
                                        <p>
                                            {{ __('Appointment Date:') }}
                                            {{ Carbon\Carbon::parse($app->booking_date)->format('d M, Y') }},
                                            {{ Carbon\Carbon::parse($app->booking_date)->format('l') }},
                                            {{ $app->booking_time }}
                                            
                                        </p>
                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    </div>
</body>

</html>
