<?php

namespace App\Repository;


class Customer
{

    public function get()
    {
        return User::all();
    }
}
