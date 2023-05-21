<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'level'=>'admin'
        ]);
        User::create([
            'name'=>'User1',
            'email'=>'userkhalis@gmail.com',
            'password'=>Hash::make('user@12345'),
            'phone'=>'081339317472',
            'level'=>'user'
        ]);
        User::create([
            'name'=>'User2',
            'email'=>'user2khalis@gmail.com',
            'password'=>Hash::make('user@12345'),
            'phone'=>'081339317472',
            'level'=>'user'
        ]);
        User::create([
            'name'=>'User3',
            'email'=>'user3khalis@gmail.com',
            'password'=>Hash::make('user@12345'),
            'phone'=>'081339317472',
            'level'=>'user'
        ]);
        User::create([
            'name'=>'User4',
            'email'=>'user4khalis@gmail.com',
            'password'=>Hash::make('user@12345'),
            'phone'=>'081339317472',
            'level'=>'user'
        ]);
        User::create([
            'name'=>'User5',
            'email'=>'user5khalis@gmail.com',
            'password'=>Hash::make('user@12345'),
            'phone'=>'081339317472',
            'level'=>'user'
        ]);
    }
}