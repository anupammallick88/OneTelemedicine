<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['slug' => 'title', 'value' => 'Zaitors']);
        Setting::create(['slug' => 'footer_copyright', 'value' => 'All Rights Reserved']);
        Setting::create(['slug' => 'contact_image', 'value' => 'contact.jpg']);
        Setting::create(['slug' => 'site_logo', 'value' => 'logo.png']);
        Setting::create(['slug' => 'favicon', 'value' => 'favicon.png']);
        Setting::create(['slug' => 'white_logo', 'value' => 'whitelogo.png']);
        Setting::create(['slug' => 'address', 'value' => '4517 Washington. Manchester,Kentucky 39495']);
        Setting::create(['slug' => 'helpline_1', 'value' => '+12 (3)456 7890 1234']);
        Setting::create(['slug' => 'helpline_2', 'value' => '(+123) 1236455 5255']);
        Setting::create(['slug' => 'helpline_email_1', 'value' => 'Zaitors12@gmail.com']);
        Setting::create(['slug' => 'helpline_email_2', 'value' => 'Zaitors25@gmail.com']);
        Setting::create(['slug' => 'preloader', 'value' => 'preloader.png']);
        Setting::create(['slug' => 'banner', 'value' => 'banner.png']);
    }
}
