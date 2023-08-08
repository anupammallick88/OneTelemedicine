<?php

namespace Database\Seeders;

use App\Models\Admin\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Menu::create([
            'label' => 'Main Menu',
            'status' => 1,
            'slug' => 'main-menu'
        ]);
        Menu::create([
            'label' => 'Quick Links',
            'status' => 1,
            'slug' => 'quick-links'

        ]);
        Menu::create([
            'label' => 'Support & Help',
            'status' => 1,
            'slug' => 'support-help'
        ]);
    }
}
