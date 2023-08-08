<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'image' => '1627887212author-image.png',
            'gender' => 'male',
            'fname' => 'Super',
            'lname' => 'Admin',
            'role' => 'admin',
            'dob' => '1987-10-13',
            'age' => '33',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Manager Project',
            'email' => 'pm@test.com',
            'password' => Hash::make('12345678'),
            'image' => '1621510731team-1.png',
            'gender' => 'female',
            'fname' => 'Jonas',
            'lname' => 'Baile',
            'role' => 'patient',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Sales Manager',
            'email' => 'sm@test.com',
            'password' => Hash::make('12345678'),
            'image' => '1621510731team-1.png',
            'gender' => 'female',
            'fname' => 'Jonas',
            'lname' => 'Baile',
            'role' => 'patient',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'hr',
            'email' => 'hr@test.com',
            'password' => Hash::make('12345678'),
            'image' => '1620930960me.jpg',
            'gender' => 'male',
            'fname' => 'Jonas',
            'lname' => 'Baile',
            'role' => 'patient',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Jonas Baile',
            'email' => 'patient@gmail.com',
            'password' => Hash::make('12345678'),
            'image' => '1622878821patient.jpg',
            'gender' => 'female',
            'fname' => 'Naida Mullen',
            'lname' => 'Kamal Bennett',
            'role' => 'patient',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Dr. Hnik Zairiya',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('12345678'),
            'image' => '1622633026team-1.png',
            'gender' => 'female',
            'fname' => 'Aidan Hyde',
            'lname' => 'Lara Barnett',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '33',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Petra Garza',
            'email' => 'roral@gmail.com',
            'password' => Hash::make('12345678'),
            'image' => '1622119279team-2.png',
            'gender' => 'male',
            'fname' => 'Dr. Dnik',
            'lname' => 'Zaman',
            'role' => 'doctor',
            'dob' => '1970-01-01',
            'age' => '33',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Lyle Schultz',
            'email' => 'xykigat@mailinator.com',
            'password' => Hash::make('12345678'),
            'image' => '1622120823team-3.png',
            'gender' => 'female',
            'fname' => 'Dr. Bnik',
            'lname' => 'Zairiya',
            'role' => 'doctor',
            'dob' => '1970-01-01',
            'age' => '33',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Lyle Schultz',
            'email' => 'xykigat2@mailinator.com',
            'password' => Hash::make('12345678'),
            'image' => '1622120968team-4.png',
            'gender' => 'female',
            'fname' => 'Dr. Gnik',
            'lname' => 'Conrel',
            'role' => 'doctor',
            'dob' => '1970-01-01',
            'age' => '33',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Rina  Chaney ',
            'email' => 'rilema@mailinator.com',
            'password' => Hash::make('12345678'),
            'gender' => 'female',
            'fname' => 'Rina Joseph',
            'lname' => 'Chaney House',
            'role' => 'patient',
            'dob' => '1970-01-01',
            'age' => '33',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);


    }
}
