<?php

namespace Database\Seeders;

use App\Models\Models\Admin\Site;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'title' => 'Zaitors',
            'footer_copyright' => '© 2021 Dortors • All Rights Reserved',
            'contact_image' => 'contact.jpg',
            'image1' => '1627883672logo.png',
            'image2' => '1627883945index.png',
            'image3' => '1627883672logo-white.png',
            'address' => '4517 Washington. Manchester,Kentucky 39495',
            'helpline1' => '(+123) 456 7890 1234',
            'helpline2' => '(+123) 1236455 5255',
            'helpline_email1' => 'Zaitors12@gmail.com',
            'helpline_email2' => 'Zaitors25@gmail.com',
        ]);
    }
}
