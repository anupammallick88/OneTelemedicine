<?php

namespace Database\Seeders;

use App\Models\TestPrescription;
use Illuminate\Database\Seeder;

class TestPrescriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestPrescription::insert([[
            'appointment_id' => 1,
            'patient_id' => 2,
            'test_name' => 'Xray',
            'test_comment' => 'xray should be ok',
        ]]);
    }
}
