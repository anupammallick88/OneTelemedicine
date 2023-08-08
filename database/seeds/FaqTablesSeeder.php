<?php

namespace Database\Seeders;

use App\Models\Admin\Faq;
use App\Models\Admin\FaqTranslation;
use Illuminate\Database\Seeder;

class FaqTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'type' => 1,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 1,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);
        Faq::create([
            'type' => 1,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 2,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);
        Faq::create([
            'type' => 2,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 3,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);

        Faq::create([
            'type' => 2,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 4,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);

        Faq::create([
            'type' => 3,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 5,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);

        Faq::create([
            'type' => 3,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 6,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);

        Faq::create([
             'type' => 4,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 7,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);

        Faq::create([
            'type' => 4,
        ]);
        FaqTranslation::create([
            'locale' => 'en',
            'faq_id' => 8,
            'question' => 'It is a long established fact that a reader will be distracted?',
            'answer' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here.',
        ]);
    }
}
