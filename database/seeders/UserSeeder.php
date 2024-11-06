<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
            'name' => 'javier',
            'email' => 'javier@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1'), // password
            'active' => true,
            'remember_token' => Str::random(10),
        ]);
    }
}
