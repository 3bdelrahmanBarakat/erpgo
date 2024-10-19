<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceProduct>
 */
class InvoiceProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'invoice_id' => rand(1, 50),
            'product_id' => rand(1, 50),
            'quantity' => rand(1, 20),
            'tax' => 0.00,
            'discount' => $this->faker->randomFloat(2, 0, 10),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
