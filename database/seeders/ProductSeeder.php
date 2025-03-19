<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 products using the factory
        Product::factory(10)->create()->each(function ($product) {
            $imagesCount = rand(1, 3);
            for ($i = 0; $i < $imagesCount; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'path/to/image' . ($i + 1) . '.jpg'
                ]);
            }
        });
    }
}
