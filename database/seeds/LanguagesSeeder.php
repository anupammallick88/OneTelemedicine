<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'prefix' => 'en',
            'name' => 'English',
            'direction' => 'ltr',
            'default' => '1',
        ]);
        Language::create([
            'prefix' => 'ar',
            'name' => 'Arabic',
            'direction' => 'rtl',
            'default' => '0',
        ]);
    }
}
