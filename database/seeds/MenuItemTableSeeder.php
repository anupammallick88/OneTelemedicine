<?php

namespace Database\Seeders;

use App\Models\Admin\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItem::create([
            'menu_id' => 2,
            'label' => 'About Us',
            'url' => '/about-us',
            'position' => 2,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 2,
            'label' => 'Faq',
            'url' => '/faq',
            'position' => 2,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 2,
            'label' => 'Gallery',
            'url' => '/gallery',
            'position' => 2,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 2,
            'label' => 'News',
            'url' => '/news',
            'position' => 2,
            'status' => 1
        ]);

        MenuItem::create([
            'menu_id' => 3,
            'label' => 'Appointment Now',
            'url' => '/doctors',
            'position' => 3,
            'status' => 1
        ]);

        MenuItem::create([
            'menu_id' => 3,
            'label' => 'Services',
            'url' => '/service',
            'position' => 3,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 3,
            'label' => 'Support',
            'url' => '/contact',
            'position' => 3,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 3,
            'label' => 'Doctors',
            'url' => '/doctors',
            'position' => 3,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 1,
            'label' => 'Home',
            'url' => '/',
            'position' => 1,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 1,
            'label' => 'About Us',
            'url' => '/about-us',
            'position' => 1,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 1,
            'label' => 'Doctors',
            'url' => '/doctors',
            'position' => 1,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 1,
            'label' => 'Services',
            'url' => '/service',
            'position' => 1,
            'status' => 1
        ]);
        MenuItem::create([
            'menu_id' => 1,
            'label' => 'Gallery',
            'url' => '/gallery',
            'position' => 1,
            'status' => 1
        ]);

        MenuItem::create([
            'menu_id' => 1,
            'label' => 'News',
            'url' => '/news',
            'position' => 1,
            'status' => 1
        ]);

        MenuItem::create([
            'menu_id' => 1,
            'label' => 'Contact',
            'url' => '/contact',
            'position' => 1,
            'status' => 1
        ]);
    }
}
