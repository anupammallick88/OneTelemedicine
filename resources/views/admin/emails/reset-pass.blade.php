<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ __('Reset Password') }}</title>
    </head>
    <body>
        <P>{{ __('Hello User') }},</P>
        <h2>{{ view_html($sub_message) }}</h2>
        <a href="{{route('resetpassword', $token)}}">{{ __('Reset Password') }}</a>
    </body>
</html>