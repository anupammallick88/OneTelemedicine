<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorDoctorSlotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = Doctor::get();

        foreach ($doctors as $doctor) {
            DB::table('doctor_doctor_slot')->insert([
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 1],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 2],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 3],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 4],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 5],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 6],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 7],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 8],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 9],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 10],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 11],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 12],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 13],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 14],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 15],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 16],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 17],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 18],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 19],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 20],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 21],
                ['doctor_id' => $doctor->id, 'doctor_slot_id' => 22],
            ]);
        }
    }
}
