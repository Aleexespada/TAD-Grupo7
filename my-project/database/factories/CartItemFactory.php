<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $user = User::factory()->create();
        $product = Product::factory()->create();

        return [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $this->faker->randomNumber(2),
            'size' => $this->faker->randomElement(['S', 'M', 'L']),
            'unity_price' => $this->faker->randomFloat(2, 1, 100),
            'subtotal' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
