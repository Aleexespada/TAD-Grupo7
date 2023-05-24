<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $brand = Brand::factory()->create();

        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(70, 500),
            'brand_id' => $brand->id,
            'status' => 'disponible',
        ];
    }
}
