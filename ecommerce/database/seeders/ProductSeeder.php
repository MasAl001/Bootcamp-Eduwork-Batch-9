<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data produk untuk setiap kategori
        $productNames = [
            'Electronics' => [
                'Wireless Bluetooth Headphones', 'USB-C Cable 2m', '4K Webcam HD', 'Portable Power Bank',
                'Mechanical Gaming Keyboard', 'Wireless Mouse Pro', 'LED Desk Lamp', 'Phone Stand',
                'USB Hub 7 Port', 'HDMI Cable 2m'
            ],
            'Fashion' => [
                'Cotton T-Shirt', 'Denim Jeans', 'Leather Jacket', 'Casual Sneakers',
                'Winter Hoodie', 'Cargo Pants', 'Polo Shirt', 'Athletic Sports Shorts',
                'Casual Blazer', 'Crew Neck Sweater'
            ],
            'Home & Garden' => [
                'Indoor Plant Pot', 'Desk Organizer Set', 'Table Lamp', 'Wall Mirror',
                'Throw Pillow Cover', 'Door Mat', 'Shelf Organizer', 'Kitchen Knife Set',
                'Bed Sheets Set', 'Wall Clock'
            ],
            'Sports & Outdoors' => [
                'Yoga Mat', 'Dumbbells Set', 'Resistance Bands', 'Running Shoes',
                'Gym Bag', 'Water Bottle 1L', 'Exercise Ball', 'Jump Rope',
                'Camping Tent', 'Bicycle Helmet'
            ],
            'Books & Media' => [
                'Programming Guide Book', 'Self-Help Novel', 'Science Fiction', 'Business Strategy',
                'Cooking Recipes Book', 'Art & Design Book', 'Biography', 'Travel Guide',
                'Learning Python Book', 'Marketing Handbook'
            ]
        ];

        $categories = ProductCategory::all();

        foreach ($categories as $category) {
            $products = $productNames[$category->name] ?? [];

            foreach ($products as $productName) {
                Product::create([
                    'name' => $productName,
                    'slug' => Str::slug($productName),
                    'description' => fake()->paragraph(),
                    'image' => 'images/products/example.jpg',
                    'price' => fake()->numberBetween(20000, 5000000),
                    'stock' => fake()->numberBetween(0, 100),
                    'product_category_id' => $category->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}