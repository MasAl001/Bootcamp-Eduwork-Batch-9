<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
        ]);

        ProductCategory::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
        ]);

        ProductCategory::create([
            'name' => 'Home & Garden',
            'slug' => 'home-garden',
        ]);

        ProductCategory::create([
            'name' => 'Books & Media',
            'slug' => 'books-media',
        ]);

        ProductCategory::create([
            'name' => 'Sports & Outdoors',
            'slug' => 'sports-outdoors',
        ]);
    }
}
