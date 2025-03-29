<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = \App\Models\Category::factory()->createMany([
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing', 'slug' => 'clothing'],
            ['name' => 'Home', 'slug' => 'home']
        ]);

        // Create products with variants
        \App\Models\Product::factory()
            ->count(5)
            ->has(\App\Models\ProductVariant::factory()->count(2), 'variants')
            ->create()
            ->each(function ($product) use ($categories) {
                // Attach random categories
                $product->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')
                );
            });
    }
}
