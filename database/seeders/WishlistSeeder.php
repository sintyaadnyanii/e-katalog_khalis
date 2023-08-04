<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the start and end dates for your desired period
        $startDate = Carbon::parse('2023-06-20');
        $endDate = Carbon::parse('2023-06-30');

        // Generate a random timestamp within the specified period
        $randomTimestamp = Carbon::createFromTimestamp(
            mt_rand($startDate->timestamp, $endDate->timestamp)
        );
            // Loop to create multiple wishlist entries
        for ($i=1; $i<50; $i++) {
            $userId = User::whereNot('id',1)->inRandomOrder()->first()->id;
            $productCode = Product::inRandomOrder()->first()->product_code;

            // Check if the wishlist entry already exists for the user and product
            $wishlist = Wishlist::firstOrNew([
                'user_id' => $userId,
                'product_code' => $productCode
            ]);

            // If the wishlist entry doesn't exist, create it
            if (!$wishlist->exists) {
                $wishlist->created_at = $randomTimestamp;
                $wishlist->updated_at = $randomTimestamp;
                $wishlist->save();
            }
        }
    }
}