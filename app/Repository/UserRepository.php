<?php

namespace App\Repository;

use App\User;

class UserRepository
{
    public function get()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::where('id', $id)->first();
    }
}
