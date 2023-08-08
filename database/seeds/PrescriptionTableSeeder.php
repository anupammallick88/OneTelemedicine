<?php

namespace Database\Seeders;

use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PrescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prescription::insert([[
            'appointment_id' => '6',
            'patient_id' => '2',
            'patient_weight' => '2',
            'patient_age' => '70',
            'patient_bp' => '90',
            'patient_temperature' => '99',
            'medicine_name' => '{"1":"napa","2":"paracitamol"}',
            'medicine_type' => '{"1":"Tablet","2":"Tablet"}',
            'medicine_quantity' => '{"1":"500","2":"500"}',
            'medicine_dose' => '{"1":"111","2":"111"}',
            'medicine_day' => '{"1":"10","2":"10"}',
            'medicine_comment' => '{"1":"continue","2":"continue"}',
            'advice' => 'after 7 days',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]]);
    }
}
