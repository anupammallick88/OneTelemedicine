<?php

namespace Database\Seeders;

use App\Models\Front\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'image' => '1622034345brand-1.png',
        ]);
        Brand::create([
            'image' => '1622034358brand-2.png',
        ]);
        Brand::create([
            'image' => '1622034374brand-3.png',
        ]);
        Brand::create([
            'image' => '1622034394brand-4.png',
        ]);
    }
}
