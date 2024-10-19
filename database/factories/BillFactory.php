<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bill_id' => $this->faker->unique()->randomNumber(5),
            'vender_id' => rand(1,10),
            'bill_date' => $this->faker->dateTimeThisMonth,
            'due_date' => $this->faker->dateTimeThisMonth,
            'order_number' => $this->faker->randomNumber(4),
            'status' => rand(1,4),
            'shipping_display' => 1,
            'send_date' => $this->faker->optional()->dateTimeThisMonth,
            'discount_apply' => 0,
            'category_id' => rand(1,25),
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
