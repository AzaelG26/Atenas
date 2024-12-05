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
            'name' => 'azaelg',
            'email' => 'azagar@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('administrador'), // password
            'active' => true,
            'google_id' => null,
	    'admin' => 1,
            'remember_token' => Str::random(10),
        ]);
    }
}
