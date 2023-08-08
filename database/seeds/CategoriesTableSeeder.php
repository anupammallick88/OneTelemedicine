<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use App\Models\Admin\CategoryTranslation;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'status' => 1,
        ]);
        Category::create([
            'status' => 1,
        ]);
        Category::create([
            'status' => 1,
        ]);
        CategoryTranslation::create([
            'locale' => 'en',
            'category_id' => 1,
            'name' => 'news',
        ]);
        CategoryTranslation::create([
            'locale' => 'en',
            'category_id' => 2,
            'name' => 'test',
        ]);
        CategoryTranslation::create([
            'locale' => 'en',
            'category_id' => 3,
            'name' => 'Neuro',
        ]);
    }
}
