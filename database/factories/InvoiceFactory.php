<?php

namespace Database\Factories;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'invoice_id' => $this->faker->unique()->randomNumber,
            'customer_id' => function () {
                return Customer::factory()->create()->id;
            },
            'issue_date' => $this->faker->dateTimeThisMonth,
            'due_date' => $this->faker->dateTimeThisMonth,
            'send_date' => $this->faker->dateTimeThisMonth,
            'category_id' => $this->faker->numberBetween(1, 10),
            'ref_number' => $this->faker->optional()->text,
            'status' => rand(1,4),
            'shipping_display' => 1,
            'discount_apply' => 0,
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
