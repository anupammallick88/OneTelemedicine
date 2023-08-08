<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
            'user_id' => 3,
            'specialist' => 'Neurologist',
            'fees' => 10,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 2,
            'profile_image' => 'profile1.jpg',
            'thumb_image' => 'thumb1.jpg',
        ]);

        Doctor::create([
            'user_id' => 4,
            'specialist' => 'Neurologist',
            'fees' => 5,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 2,
            'profile_image' => 'profile2.jpg',
            'thumb_image' => 'thumb2.jpg',
        ]);

        Doctor::create([
            'user_id' => 5,
            'specialist' => 'darmatologist',
            'fees' => 20,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 3,
            'profile_image' => 'profile3.jpg',
            'thumb_image' => 'thumb3.jpg',
        ]);

        Doctor::create([
            'user_id' => 6,
            'specialist' => 'Gynycology',
            'fees' => 50,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 1,
            'profile_image' => 'profile4.jpg',
            'thumb_image' => 'thumb4.jpg',
        ]);

        Doctor::create([
            'user_id' => 7,
            'specialist' => 'Cardiologist',
            'fees' => 80,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 5,
            'profile_image' => 'profile5.jpg',
            'thumb_image' => 'thumb5.jpg',
        ]);

        Doctor::create([
            'user_id' => 8,
            'specialist' => 'Nephrologist',
            'fees' => 50,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 6,
            'profile_image' => 'profile6.jpg',
            'thumb_image' => 'thumb6.jpg',
        ]);

        Doctor::create([
            'user_id' => 9,
            'specialist' => 'Nephrologist',
            'fees' => 20,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 6,
            'profile_image' => 'profile7.jpg',
            'thumb_image' => 'thumb7.jpg',
        ]);
        Doctor::create([
            'user_id' => 10,
            'specialist' => 'Ophthalmologists',
            'fees' => 20,
            'offday' => 'fri',
            'starttime' => '09:00',
            'endtime' => '13:00',
            'starttime2' => '15:00',
            'endtime2' => '20:00',
            'category_id' => 4,
            'profile_image' => 'profile8.jpg',
            'thumb_image' => 'thumb8.jpg',
        ]);
    }
}
