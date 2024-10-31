<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Characteristic;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Product::factory(20)->create()->each(function ($product) {
            $product->characteristics()->createMany(
                Characteristic::factory(3)->make()->toArray()
            );
            $product->reviews()->createMany(
                Review::factory(2)->make()->toArray()
            );
        });
    }
}
