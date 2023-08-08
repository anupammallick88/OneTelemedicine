<?php

namespace Database\Seeders;

use App\Models\Front\Service;
use App\Models\Front\ServiceTranslation;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'user_id' => '1',
            'image' => '1627884302service-4.png',
            'icon' => '1627884302service-icon-1.png',
            'tags' => 'surgical',
            'status' => '1',
        ]);

        ServiceTranslation::create([
            'locale' => 'en',
            'service_id' => 1,
            'title' => 'Surgical',
            'description' => 'It is a long established fact that reader will be distracted  readable content.',
            'details' => '<h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Wide Range Of Facilities And Medical Services.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden</p><h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Neurlogy Place Medical Hospital Center.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its It is a long established fact that a reader will be distracted.</p><ul class="service-feature" style="margin-right: 0px; margin-bottom: 3.5rem; margin-left: 0px; -webkit-tap-highlight-color: transparent; list-style: outside none none; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;"><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted.</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li></ul>',
        ]);

        Service::create([
            'user_id' => '1',
            'image' => '1622117595service-2.png',
            'icon' => '1622117595service-icon-2.png',
            'tags' => 'gyne',
            'status' => '1',
        ]);

        ServiceTranslation::create([
            'locale' => 'en',
            'service_id' => 2,
            'title' => 'Gynecology',
            'description' => 'It is a long established fact that reader will be distracted  readable content.',
            'details' => '<h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Wide Range Of Facilities And Medical Services.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden</p><h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Neurlogy Place Medical Hospital Center.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its It is a long established fact that a reader will be distracted.</p><ul class="service-feature" style="margin-right: 0px; margin-bottom: 3.5rem; margin-left: 0px; -webkit-tap-highlight-color: transparent; list-style: outside none none; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;"><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted.</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li></ul>',

        ]);

        Service::create([
            'user_id' => '1',
            'image' => '1622117686service-3.png',
            'icon' => '1622117686service-icon-3.png',
            'tags' => 'plastic',
            'status' => '1',
        ]);
        ServiceTranslation::create([
            'locale' => 'en',
            'service_id' => 3,
            'title' => 'Plastic Surgery',
            'description' => 'It is a long established fact that reader will be distracted  readable content.',
            'details' => '<h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Wide Range Of Facilities And Medical Services.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden</p><h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Neurlogy Place Medical Hospital Center.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its It is a long established fact that a reader will be distracted.</p><ul class="service-feature" style="margin-right: 0px; margin-bottom: 3.5rem; margin-left: 0px; -webkit-tap-highlight-color: transparent; list-style: outside none none; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;"><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted.</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li></ul>',
        ]);

        Service::create([
            'user_id' => '1',
            'image' => '1622625665service-5.png',
            'icon' => '1622625665service-icon-5.png',
            'tags' => 'dental',
            'status' => '1',
        ]);
        ServiceTranslation::create([
            'locale' => 'en',
            'service_id' => 4,
            'title' => 'Dental',
            'description' => 'It is a long established fact that reader will be distracted  readable content.',
            'details' => '<h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Wide Range Of Facilities And Medical Services.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden</p><h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Neurlogy Place Medical Hospital Center.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its It is a long established fact that a reader will be distracted.</p><ul class="service-feature" style="margin-right: 0px; margin-bottom: 3.5rem; margin-left: 0px; -webkit-tap-highlight-color: transparent; list-style: outside none none; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;"><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted.</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li></ul>',
        ]);

        Service::create([
            'user_id' => '1',
            'image' => '1622625757service-4.png',
            'icon' => '1622625757service-icon-4.png',
            'tags' => 'eye',
            'status' => '1',
        ]);
        ServiceTranslation::create([
            'locale' => 'en',
            'service_id' => 5,
            'title' => 'Eye Specialist',
            'description' => 'It is a long established fact that reader will be distracted  readable content.',
            'details' => '<h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Wide Range Of Facilities And Medical Services.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden</p><h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Neurlogy Place Medical Hospital Center.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its It is a long established fact that a reader will be distracted.</p><ul class="service-feature" style="margin-right: 0px; margin-bottom: 3.5rem; margin-left: 0px; -webkit-tap-highlight-color: transparent; list-style: outside none none; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;"><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted.</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li></ul>',
        ]);

        Service::create([
            'user_id' => '1',
            'image' => '1622633259service-1.png',
            'icon' => '1622633259service-icon-1.png',
            'tags' => 'neurology',
            'status' => '1',
        ]);
        ServiceTranslation::create([
            'locale' => 'en',
            'service_id' => 6,
            'title' => 'Neurology',
            'description' => 'It is a long established fact that reader will be distracted  readable content.',
            'details' => '<h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Wide Range Of Facilities And Medical Services.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden</p><h3 class="service-details-title" style="margin-bottom: 2rem; font-size: 2.4rem; font-family: Poppins, sans-serif; text-transform: capitalize;">Neurlogy Place Medical Hospital Center.</h3><p class="service-details-content" style="margin-right: 0px; margin-bottom: 24px; margin-left: 0px; font-size: 1.5rem; line-height: 2.7rem; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif;">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its It is a long established fact that a reader will be distracted.</p><ul class="service-feature" style="margin-right: 0px; margin-bottom: 3.5rem; margin-left: 0px; -webkit-tap-highlight-color: transparent; list-style: outside none none; padding: 0px; color: rgb(102, 102, 102); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;"><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted.</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li><li style="-webkit-tap-highlight-color: transparent; position: relative; margin-bottom: 2rem; padding-left: 3rem; font-size: 1.5rem; color: var(--bColor);">It is a long established fact that a reader will be distracted by .</li></ul>',
        ]);
    }
}
