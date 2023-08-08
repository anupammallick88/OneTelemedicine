<?php

namespace Database\Seeders;

use App\Models\Front\Social;
use Illuminate\Database\Seeder;

class SocialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Social::create([
            'name' => 'facebook',
            'url' => 'https://www.facebook.com',
            'class' => 'fab fa-facebook-f',
        ]);

        Social::create([
            'name' => 'Google plus',
            'url' => 'https://www.google.com',
            'class' => 'fab fa-google-plus-g',
        ]);
        Social::create([
            'name' => 'linkdin',
            'url' => 'https://www.linkdin.com',
            'class' => 'fab fa-linkedin-in',
        ]);
        Social::create([
            'name' => 'pinterest',
            'url' => 'https://www.pinterest.com',
            'class' => 'fab fa-pinterest-p',
        ]);
    }
}
