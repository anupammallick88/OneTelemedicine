<?php

namespace Database\Seeders;

use App\Models\Front\GallerySection;
use Illuminate\Database\Seeder;

class GallerySectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GallerySection::create([
            'image' => '1627883028gallery-bg.png'
        ]);
    }
}
