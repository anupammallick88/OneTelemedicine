<?php

namespace Database\Seeders;

use App\Models\Admin\Gallery;
use Illuminate\Database\Seeder;

class GalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::create([
            'service_id' => '1',
            'image' => '1627884048gallery-1.jpg'
        ]);
        Gallery::create([
            'service_id' => '2',
            'image' => '1622117808gallery-2.jpg'
        ]);
        Gallery::create([
            'service_id' => '1',
            'image' => '1622117866gallery-3.jpg'
        ]);
        Gallery::create([
            'service_id' => '1',
            'image' => '1622117897gallery-4.jpg'
        ]);
        Gallery::create([
            'service_id' => '1',
            'image' => '1622117925gallery-5.jpg'
        ]);
        Gallery::create([
            'service_id' => '1',
            'image' => '1622117951gallery-6.jpg'
        ]);
    }
}
