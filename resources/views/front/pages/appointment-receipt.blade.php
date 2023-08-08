<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Appointment Receipt') }}</title>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
</head>

<body>
    <h1>{{ __('Receipt') }}</h1><br>
    <h5>{{ $appointment->patient->name }}</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">{{ __('Doctor') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Type') }}</th>
                <th scope="col">{{ __('Payment') }}</th>
                <th scope="col">{{ __('Amount') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $appointment->doctor->user->name }}</td>
                <td>{{ $appointment->appdate }}</td>
                <td>{{ $appointment->type == OFFLINE ? __('main.Offline') : __('main.Online') }}</td>
                <td>{{ $appointment->paymentmethod == 'cod' ? 'Spot Payment' : ucfirst($appointment->paymentmethod) }}
                </td>
                <td>{{ $appointment->fees }}</td>
            </tr>
        </tbody>
    </table>

</body>
