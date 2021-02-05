<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Carl Cassar',
            'email' => 'carl@carlcassar.com',
            'password' => bcrypt('password')
        ]);
    }
}
