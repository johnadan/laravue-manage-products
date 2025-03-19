<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'apparel/fashion',
            'electronics/gadgets',
            'beauty/care',
            'school/office supplies',
            'furniture/appliances'
        ];

        return [
            'name'        => $this->faker->word,
            'category'    => $this->faker->randomElement($categories),
            'description' => $this->faker->paragraph,
            'date_time'   => $this->faker->dateTime,
        ];
    }
}
