<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillProduct>
 */
class BillProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bill_id' => $this->faker->numberBetween(1, 50),
            'product_id' => $this->faker->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
            'discount' => $this->faker->randomFloat(2, 0, 10),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
