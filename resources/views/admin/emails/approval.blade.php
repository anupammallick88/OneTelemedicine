<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Approval Appointment') }}</title>
</head>
<body>
<P>{{ __('Hello User') }},</P>
<h2>{{ __('Your appointment is approved by doctor. Please click to') }} <a href="{{route('appointment.receipt', $appointment_id)}}" target="_blank">{{__('download')}}</a> {{__('your receipt.')}}</h2>
</body>
</html>
