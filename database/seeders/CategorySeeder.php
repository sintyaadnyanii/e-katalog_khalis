<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Bamboo Tray',
            'slug'=>'bamboo-tray',
            'description'=>'Food tray made from bamboo',
        ]);
        Category::create([
            'name'=>'Bamboo Cutleries',
            'slug'=>'bamboo-cutleries',
            'description'=>'Cutleries made from bamboo',
        ]);
    }
}