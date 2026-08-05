<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'price' => fake()->numberBetween(20000, 5000000),
            'stock' => fake()->numberBetween(0, 100),
            'product_category_id' => ProductCategory::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
