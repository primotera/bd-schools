<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'name' => 'Abdoulaye',
            'email' => 'abdoulaye' . Str::random(5) . '@admin.com',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Oumar',
            'email' => 'oumar' . Str::random(5) . '@user.com',
            'password' => Hash::make('password123')
        ]);
        User::create([
            'role_id' => 1,
            'name' => 'Joelle',
            'email' => 'joelle' . Str::random(5) . '@admin.com',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Ornelle',
            'email' => 'ornelle' . Str::random(5) . '@user.com',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Aissatou',
            'email' => 'aissatou' . Str::random(5) . '@user.com',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Yaye',
            'email' => 'yaye' . Str::random(5) . '@user.com',
            'password' => Hash::make('password123')
        ]);
    }
}
