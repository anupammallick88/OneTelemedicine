<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',


    'form'              => [

        'email'                     => 'Email',
        'password'                  => 'Password',
        'select'                    => 'Select User',
        'select_field'              => 'Field Officer',
        'select_upozilla'           => 'Upozilla Officer',
        'select_prokolpo'           => 'Prokolpo Officer',
        'remember'                  => 'Remember Me',
        'login_button'              => 'Login',
        'submit'                    => 'Submit',
        'email_placeholder'         => 'Enter your email',
        'password_placeholder'      => 'Enter your password',




        'relative_mobile'           => 'Enter Your Mobile Number',
        'relative_mobile_placeholder'=> 'Enter your mobile number',
        'relative_otp_placeholder' => 'OTP: 1234',


        'validation'    => [
            'email' => [
                'required'  => 'The email field is required!',
                'email'     => 'The email needs to have a valid format.',
                'exists'    => 'The email is not registered in the system.',
            ],


            'password' => [
                'required'  => 'The password field is required!',
                'same'      => 'The password and confirm-password must match.',
            ],

            'relative_mobile' => [
                'required'  => 'This field is required!',
                'max'       => 'The mobile number must not be more than 14 character.',
            ],

            'relative_mobile' => [
                'required'  => 'This field is required!',
                'max'       => 'The mobile number must not be more than 4 character.',
            ],

            'mobile' => [
                'required'  => 'This field is required!',
                'max'       => 'The mobile number must not be more than 14 character.',
            ],
        ],
    ],

];
