<?php

namespace Database\Seeders;

use App\Models\Front\About;
use App\Models\Front\AboutTranslation;
use Illuminate\Database\Seeder;

class AboutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'image' => '1627882897about-image.png',
            'icon_one' => 'flaticon-alarm',
            'icon_two' => 'flaticon-headphones',
            'icon_three' => 'flaticon-stethoscope',
        ]);
        AboutTranslation::create([
            'locale' => 'en',
            'about_id' => 1,
            'title' => 'A Great place of medical care hospital center.',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'icon_one_title' => 'Emergency Support',
            'icon_one_description' => 'It is a long established fact that a distracted.',
            'icon_two_title' => '24/7 Support',
            'icon_two_description' => 'Content of a page when looking at its layout.',
            'icon_three_title' => 'Free Chekup',
            'icon_three_description' => 'Reader will be distracted by the readable content'
        ]);
    }
}
