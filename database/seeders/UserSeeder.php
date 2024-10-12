<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Rinu Yatim',
            'email' => 'devnirux@gmail.com',
            'username' => 'devnirux',
            'password' => Hash::make(env("APP_USER_PASSWORD_SEEDED")),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Christa Yatim-Andriessen',
            'email' => 'christa91@live.nl',
            'password' => Hash::make(env("APP_USER_PASSWORD_SEEDED")),
        ]);
    }
}
