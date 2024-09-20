<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
            'email'=>'adminkhalis@testmail.com',
            'password'=>Hash::make('admin@12345'),
            'phone'=>'081000000123',
            'level'=>'admin',
            'active'=>1,
            'verification_token'=>Str::random(50)
        ]);

        $faker=Faker::create('id_ID');
        for($i=1;$i<=25;$i++){
            User::create([
                'name'=>$faker->name,
                'email'=>"userkhalis".$faker->unique()->numberBetween(00,30)."@testmail.com",
                'password'=>Hash::make('user@12345'),
                'phone'=>'08'.$faker->numberBetween(800000000,900000000),
                'level'=>'user',
                'active'=>1,
                'verification_token'=>Str::random(50)
            ]);
        }
    }
}