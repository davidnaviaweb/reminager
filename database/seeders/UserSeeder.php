<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Luca',
            'email' => 'luca@reminager.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'David',
            'email' => 'david@reminager.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Germán',
            'email' => 'german@reminager.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
