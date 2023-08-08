<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
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
            'password' => Hash::make('password'),
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
            'name' => 'Jonas Baile',
            'email' => 'patient@gmail.com',
            'password' => Hash::make('password'),
            'image' => '1622878821patient.jpg',
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
            'name' => 'Dr. Hnik Zairiya',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('password'),
            'image' => 'thumb1.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'female',
            'fname' => 'Dr. Hnik',
            'lname' => 'Zairiya',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'stuff jon',
            'email' => 'stuff@gmail.com',
            'password' => Hash::make('password'),
            'image' => '1622878821patient.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'female',
            'fname' => 'stuff',
            'lname' => 'jon',
            'role' => 'stuff',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
            'doctor_id' => '3',
        ]);

        User::create([
            'name' => 'Petra Garza',
            'email' => 'roral@mailinator.com',
            'password' => Hash::make('password'),
            'image' => 'thumb2.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'male',
            'fname' => 'Petra',
            'lname' => 'Garza',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Lyle Schultz',
            'email' => 'xykigat@mailinator.com',
            'password' => Hash::make('password'),
            'image' => 'thumb3.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'female',
            'fname' => 'Lyle',
            'lname' => 'Schultz',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Gnik Conrel',
            'email' => 'rilema@mailinator.com',
            'password' => Hash::make('password'),
            'image' => 'thumb4.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'female',
            'fname' => 'Gnik',
            'lname' => 'Conrel',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'John doe',
            'email' => 'doctor6@gmail.com',
            'password' => Hash::make('password'),
            'image' => 'thumb5.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'male',
            'fname' => 'John',
            'lname' => 'doe',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'Axel Simon',
            'email' => 'doctor7@gmail.com',
            'password' => Hash::make('password'),
            'image' => 'thumb6.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'male',
            'fname' => 'Axel Simon',
            'lname' => 'Bell Tanner',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        User::create([
            'name' => 'MacKensie Duke',
            'email' => 'mywepuga@mailinator.com',
            'password' => Hash::make('password'),
            'image' => 'thumb7.jpg',
            'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
            'gender' => 'male',
            'fname' => 'MacKensie Duke',
            'lname' => 'Malik Tate',
            'role' => 'doctor',
            'dob' => '1999-05-21',
            'age' => '27',
            'address' => 'Hill street',
            'city' => 'USA',
            'code' => '1300',
        ]);
        // User::create([
        //     'name' => 'Robert Gomez',
        //     'email' => 'rgomez@mailinator.com',
        //     'password' => Hash::make('password'),
        //     'image' => 'thumb8.jpg',
        //     'bio' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors.',
        //     'gender' => 'male',
        //     'fname' => 'Robert',
        //     'lname' => 'Gomez',
        //     'role' => 'doctor',
        //     'dob' => '1999-05-21',
        //     'age' => '27',
        //     'address' => 'Hill street',
        //     'city' => 'USA',
        //     'code' => '1300',
        // ]);
    }
}
