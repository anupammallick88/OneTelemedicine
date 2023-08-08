<?php

namespace Database\Seeders;

use App\Models\DoctorCategory;
use Illuminate\Database\Seeder;

class DoctorCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorCategory::create([
            'name' => 'Gynycologist'
        ]);
        DoctorCategory::create([
            'name' => 'Neurologist'
        ]);
        DoctorCategory::create([
            'name' => 'Darmatologist'
        ]);
        DoctorCategory::create([
            'name' => 'Ophthalmologists'
        ]);
        DoctorCategory::create([
            'name' => 'Cardiologist'
        ]);
        DoctorCategory::create([
            'name' => 'Nephrologist'
        ]);
    }
}
