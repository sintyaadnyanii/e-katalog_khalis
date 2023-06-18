<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name'=>'Administrator',
            'email'=>'adminkhalis@gmail.com',
            'password'=>Hash::make('admin@12345'),
            'phone'=>'081339317472',
            'level'=>'admin',
            'active'=>1,
            'verification_token'=>Str::random(50)
        ]);
    }
}