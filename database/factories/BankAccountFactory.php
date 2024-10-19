<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankAccount>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'holder_name' => $this->faker->name,
            'bank_name' => $this->faker->word,
            'account_number' => $this->faker->bankAccountNumber,
            'opening_balance' => $this->faker->randomFloat(2, 0, 10000),
            'contact_number' => $this->faker->phoneNumber,
            'bank_address' => $this->faker->address,
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
