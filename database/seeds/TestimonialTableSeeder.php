<?php

namespace Database\Seeders;

use App\Models\Front\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testimonial::create([
            'user_id' => 1,
            'image' => '1627883086comment-3.png',
            'name' => 'Jakson Hoder',
            'occupation' => 'Manager',
            'Title' => 'Excellent Services',
            'description' => '<p><span style="color: rgb(34, 34, 34); font-family: &quot;dejavu sans mono&quot;, monospace; font-size: 11px; white-space: pre-wrap;">There are many variations of passages of Lorem Ipsum available,</span><br></p>',
            'star' => 1,
            'status' => 1,
        ]);
        Testimonial::create([
            'user_id' => 1,
            'image' => '1622118151testimonial-image2.png',
            'name' => 'Jakson Hoder',
            'occupation' => 'Manager',
            'Title' => 'Excellent Services',
            'description' => '<p><span style="color: rgb(34, 34, 34); font-family: &quot;dejavu sans mono&quot;, monospace; font-size: 11px; white-space: pre-wrap;">There are many variations of passages of Lorem Ipsum available,</span><br></p>',
            'star' => 4,
            'status' => 1,
        ]);
        Testimonial::create([
            'user_id' => 1,
            'image' => '1622118257testimonial-image1.png',
            'name' => 'Jakson Hoder',
            'occupation' => 'Manager',
            'Title' => 'Excellent Services',
            'description' => '<p><span style="color: rgb(34, 34, 34); font-family: &quot;dejavu sans mono&quot;, monospace; font-size: 11px; white-space: pre-wrap;">There are many variations of passages of Lorem Ipsum available,</span><br></p>',
            'star' => 5,
            'status' => 1,
        ]);
    }
}
