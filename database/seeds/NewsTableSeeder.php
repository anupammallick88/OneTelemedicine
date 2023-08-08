<?php

namespace Database\Seeders;

use App\Models\Admin\News;
use App\Models\Admin\NewsTranslation;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::create([
            'user_id' => 1,
            'category_id' => 1,
            'status' => 1,
            'tags' => 'news',
            'image' => '1.jpg',
            'image_alt' => 'alt',
        ]);

        NewsTranslation::create([
            'locale' => 'en',
            'news_id' => 1,
            'title' => 'How To Handle Patient Body In MRI Pressor Heles',
            'description' => 'There are many variations of passages of Lorem Ipsum available, but have suffered alteration in some form, by injected humour.',
            'details' => "<p>There are many variations of passages of Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
            <p>There are many variations of passages of  Ipsum available, but the majority have suffered alteration in some.</p>
            <p>There are many variations of passages of  Ipsum available, but the majority have suffered alteration in some form, by
           injected humour, or randomised words which don't look even slightly
           believable.suffered alteration in some form, by injected humour, or
           randomised words which don't look even slightly believable.</p>"
        ]);

        News::create([
            'user_id' => 1,
            'category_id' => 1,
            'status' => 1,
            'tags' => 'news',
            'image' => '2.jpg',
            'image_alt' => 'alt',
        ]);

        NewsTranslation::create([
            'locale' => 'en',
            'news_id' => 2,
            'title' => 'Cleveland Clinic forecasts latest COVID-19 surge will soon peak as nation sees declining hospitalizations ',
            'description' => 'The update comes as hospitalization rates in the U.S. are finally trending downward after a summer surge',
            'details' => "<p>The delta variant helped fuel the rise in cases, hospitalizations and deaths this summer even though vaccinations became readily available to many Americans. The variant grabbed hold in areas with low vaccinations rates, frustrating providers who had to again scale back non-emergency procedures amid staffing challenges.</p>
            <p>As of Tuesday, hospitalizations in the U.S. are down 16% over the past two weeks, according to the 14-day average from data compiled by The New York Times.</p>
            <p>The U.S. reached a turning point in this year's summer surge earlier this month, according to the seven-day averages. The average hospitalizations reached a peak on Sept. 3, started to decline the next day and have been trending down ever since, according to data compiled by the Times.</p>"
        ]);

        News::create([
            'user_id' => 1,
            'category_id' => 1,
            'status' => 1,
            'image' => '3.jpg',
            'image_alt' => 'alt',
            'tags' => 'doctor',
        ]);

        NewsTranslation::create([
            'locale' => 'en',
            'news_id' => 3,
            'title' => 'More than half of states will see nursing demand outstrip supply in the next 5 years',
            'description' => 'Mental health workers will also be in high demand and short supply in some states in the coming years.',
            'details' => "<p>The pandemic spurred massive workforce disruptions across all industries, especially in healthcare. Those workers, many of whom are unable to work from home, have witnessed the toll of the virus first-hand and are grappling with burnout that has some rethinking their careers. It also gave rise to changes in healthcare delivery, namely virtual care and home healthcare services.</p>
            <p>In the next five years, the supply of certain healthcare workers and demand for others will shift, especially across local markets, according to a Mercer report. Hospitals and other providers tend to serve specific local markets, and unlike industries such as technology and manufacturing, they're limited in moving clinical work outside their markets.</p>
            <p>That comes as expenses are rising for health systems that are scrambling to find enough workers amid the COVID-19 pandemic. </p>"
        ]);

        News::create([
            'user_id' => 1,
            'category_id' => 1,
            'status' => 1,
            'image' => '4.jpg',
            'image_alt' => 'alt',
            'tags' => 'doctor',
        ]);

        NewsTranslation::create([
            'locale' => 'en',
            'news_id' => 4,
            'title' => 'Delta patients clog hospitals, spur more procedure delays ',
            'description' => 'Intermountain is the latest system to announce its putting non-emergency procedures back on hold at 13 of its hospitals',
            'details' => "<p>Just as patients started returning for care they delayed throughout the COVID-19 pandemic, hospitals are again having to put non-emergency procedures on hold to free up resources for patients hospitalized with the delta variant of the coronavirus.</p>
            <p>Salt Lake City-based Intermountain Healthcare is the latest system to announce it's postponing elective procedures starting Wednesday at 13 of its hospitals, and expects the pause to last several weeks, CEO Marc Harrison said during a Friday press conference.</p>
            <p>The system's ICUs are at more than 100% capacity and among those hospitalized with the virus, 87% are unvaccinated, Harrison said.</p>
            <p>Intermountain follows other systems in pockets of the country like Advent Health in Florida that have chosen to cut off some of their most lucrative services in order to care for surges of COVID-19 patients. Hospitals took an major financial hit when they delayed procedures early in the pandemic, either by orders from CMS or local officials, and now some are doing so voluntarily.</p>"
        ]);
    }
}
