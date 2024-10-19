<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankTransfer>
 */
class BankTransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'from_account' => $this->faker->numberBetween(1, 10), // Replace with the appropriate range
            'to_account' => $this->faker->numberBetween(1, 10), // Replace with the appropriate range
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'date' => $this->faker->dateTimeThisMonth,
            'payment_method' => $this->faker->numberBetween(1, 3), // Replace with the appropriate range
            'reference' => $this->faker->text(20),
            'description' => $this->faker->paragraph,
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
