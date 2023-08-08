<?php

namespace Database\Seeders;

use App\Models\Earning;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EarningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Earning::insert([
            [
                'doctor_id' => '1',
                'earning' => 10,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'earning' => 10,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'earning' => 10,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'earning' => 10,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'earning' => 10,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'doctor_id' => '1',
                'earning' => 10,
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
