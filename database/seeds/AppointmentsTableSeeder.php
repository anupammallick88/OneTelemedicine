<?php

namespace Database\Seeders;

use App\Models\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::insert([
            [
                'doctor_id' => '1',
                'fees' => 10,
                'user_id' => '2',
                'appdate' => '2022-06-17',
                'apptime' => '21',
                'doctorsService' => 'Neurologist',
                'comment' => 'I am ill',
                'paymentmethod' => 'Stripe',
                'charge_id' => 'blabla',
                'type' => '1',
                'status' => '0',
                'is_paid' => '1',
                'slot_id' => 21,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'fees' => 10,
                'user_id' => '2',
                'appdate' => '2022-06-18',
                'apptime' => '19',
                'doctorsService' => 'Neurologist',
                'comment' => 'I am sick',
                'paymentmethod' => 'Paypal',
                'charge_id' => 'PAYID-MKWGROY0DD48961AN883580L',
                'type' => '0',
                'status' => '0',
                'is_paid' => '1',
                'slot_id' => 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'fees' => 10,
                'user_id' => '2',
                'appdate' => '2022-06-18',
                'apptime' => '19',
                'doctorsService' => 'Neurologist',
                'comment' => 'I am sick',
                'paymentmethod' => 'Paypal',
                'charge_id' => 'PAYID-MKWGROY0DD48961AN883580L',
                'type' => '0',
                'status' => '0',
                'is_paid' => '1',
                'slot_id' => 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'fees' => 10,
                'user_id' => '2',
                'appdate' => '2022-06-18',
                'apptime' => '19',
                'doctorsService' => 'Neurologist',
                'comment' => 'I am sick',
                'paymentmethod' => 'Paypal',
                'charge_id' => 'PAYID-MKWGROY0DD48961AN883580L',
                'type' => '0',
                'status' => '0',
                'is_paid' => '1',
                'slot_id' => 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'fees' => 10,
                'user_id' => '2',
                'appdate' => '2022-06-18',
                'apptime' => '19',
                'doctorsService' => 'Neurologist',
                'comment' => 'I am sick',
                'paymentmethod' => 'Paypal',
                'charge_id' => 'PAYID-MKWGROY0DD48961AN883580L',
                'type' => '0',
                'status' => '0',
                'is_paid' => '1',
                'slot_id' => 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'fees' => 10,
                'user_id' => '2',
                'appdate' => '2022-06-17',
                'apptime' => '11',
                'doctorsService' => 'Neurologist',
                'comment' => 'I am sick',
                'paymentmethod' => 'sslcommerz',
                'charge_id' => '62ac6c5bc51df',
                'type' => '0',
                'status' => '2',
                'is_paid' => '1',
                'slot_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

        ]);
    }
}
