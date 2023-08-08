<?php

namespace Database\Seeders;

use App\Models\Front\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'name' => 'Aurelia Wells',
            'email' => 'qafehiki@mailinator.com',
            'massage' => 'Quia voluptates eius',
        ]);
    }
}
