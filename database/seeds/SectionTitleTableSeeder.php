<?php

namespace Database\Seeders;

use App\Models\Front\SectionTitle;
use App\Models\Front\SectionTitleTranslation;
use Illuminate\Database\Seeder;

class SectionTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SectionTitle::create([
            'name' => 'gallery-section',
        ]);
        SectionTitleTranslation::create([
            'locale' => 'en',
            'section_title_id' => 1,
            'title' => 'Our Service Gallery',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
        ]);
        SectionTitle::create([
            'name' => 'doctor-section',
        ]);
        SectionTitleTranslation::create([
            'locale' => 'en',
            'section_title_id' => 2,
            'title' => 'Most Popular Doctors',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
        ]);
        SectionTitle::create([
            'name' => 'testimonial-section',
        ]);

        SectionTitleTranslation::create([
            'locale' => 'en',
            'section_title_id' => 3,
            'title' => 'What Other People are Saying',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
        ]);
        SectionTitle::create([
            'name' => 'news-section',
        ]);
        SectionTitleTranslation::create([
            'locale' => 'en',
            'section_title_id' => 4,
            'title' => 'Stories, Tips & Latest News',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
        ]);
        SectionTitle::create([
            'name' => 'service-section',
        ]);
        SectionTitleTranslation::create([
            'locale' => 'en',
            'section_title_id' => 5,
            'title' => 'Our Medical Service',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
        ]);
        SectionTitle::create([
            'name' => 'faq-section',
        ]);
        SectionTitleTranslation::create([
            'locale' => 'en',
            'section_title_id' => 6,
            'title' => 'Faq Section',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'
        ]);
    }
}
