<?php

namespace Database\Seeders;

use App\Models\DoctorSlot;
use Illuminate\Database\Seeder;

class DoctorSlotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorSlot::create([
            'start_time' => '08:00',
            'end_time' => '08:30',
        ]);

        DoctorSlot::create([
            'start_time' => '08:30',
            'end_time' => '09:00',
        ]);

        DoctorSlot::create([
            'start_time' => '09:00',
            'end_time' => '09:30',
        ]);

        DoctorSlot::create([
            'start_time' => '09:30',
            'end_time' => '10:00',
        ]);

        DoctorSlot::create([
            'start_time' => '10:00',
            'end_time' => '10:30',
        ]);

        DoctorSlot::create([
            'start_time' => '10:30',
            'end_time' => '11:00',
        ]);

        DoctorSlot::create([
            'start_time' => '11:00',
            'end_time' => '11:30',
        ]);

        DoctorSlot::create([
            'start_time' => '11:30',
            'end_time' => '12:00',
        ]);

        DoctorSlot::create([
            'start_time' => '12:00',
            'end_time' => '12:30',
        ]);

        DoctorSlot::create([
            'start_time' => '12:30',
            'end_time' => '13:00',
        ]);

        DoctorSlot::create([
            'start_time' => '13:00',
            'end_time' => '13:30',
        ]);

        DoctorSlot::create([
            'start_time' => '13:30',
            'end_time' => '14:00',
        ]);

        DoctorSlot::create([
            'start_time' => '14:00',
            'end_time' => '14:30',
        ]);

        DoctorSlot::create([
            'start_time' => '14:30',
            'end_time' => '15:00',
        ]);

        DoctorSlot::create([
            'start_time' => '15:00',
            'end_time' => '15:30',
        ]);

        DoctorSlot::create([
            'start_time' => '15:30',
            'end_time' => '16:00',
        ]);

        DoctorSlot::create([
            'start_time' => '16:00',
            'end_time' => '16:30',
        ]);

        DoctorSlot::create([
            'start_time' => '16:30',
            'end_time' => '16:00',
        ]);

        DoctorSlot::create([
            'start_time' => '17:00',
            'end_time' => '17:30',
        ]);

        DoctorSlot::create([
            'start_time' => '17:30',
            'end_time' => '18:00',
        ]);

        DoctorSlot::create([
            'start_time' => '18:00',
            'end_time' => '18:30',
        ]);

        DoctorSlot::create([
            'start_time' => '18:30',
            'end_time' => '19:00',
        ]);
    }
}
