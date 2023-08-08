<?php

namespace Database\Seeders;

use App\Models\Front\Counter;
use App\Models\Front\CounterTranslation;
use Illuminate\Database\Seeder;

class CountersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Counter::create([
            'background_image' => '1622033411counter-bg.jpg',
            'image' => '1627882934video-image.png',
            'video' => 'https://www.youtube.com/watch?v=gsE79koWuVg',
            'counter_one_icon' => 'flaticon-group',
            'counter_two_icon' => 'flaticon-group',
            'counter_three_icon' => 'flaticon-briefcase',
            'counter_four_icon' => 'flaticon-medal',
        ]);
        CounterTranslation::create([
            'locale' => 'en',
            'counter_id' => 1,
            'counter_one_count' => 68962,
            'counter_one_title' => 'Total Clients',
            'counter_two_count' => 58962,
            'counter_two_title' => 'Saticfied Clients',
            'counter_three_count' => 689,
            'counter_three_title' => 'Business Partner',
            'counter_four_count' => 488,
            'counter_four_title' => 'Total Clients',
        ]);
    }
}
