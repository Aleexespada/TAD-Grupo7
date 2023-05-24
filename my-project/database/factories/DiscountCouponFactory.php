<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiscountCoupon>
 */
class DiscountCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'percentage' => $this->faker->numberBetween(1, 50),
            'uses_limit' => $this->faker->numberBetween(1, 100),
        ];
    }
}
