<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->unique()->randomNumber,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'contact' => $this->faker->phoneNumber,
            'avatar' => $this->faker->imageUrl(100, 100),
            'is_active' => 1,
            'email_verified_at' => now(),
            'billing_name' => $this->faker->name,
            'billing_country' => $this->faker->country,
            'billing_state' => $this->faker->state,
            'billing_city' => $this->faker->city,
            'billing_phone' => $this->faker->phoneNumber,
            'billing_zip' => $this->faker->postcode,
            'billing_address' => $this->faker->address,
            'shipping_name' => $this->faker->name,
            'shipping_country' => $this->faker->country,
            'shipping_state' => $this->faker->state,
            'shipping_city' => $this->faker->city,
            'shipping_phone' => $this->faker->phoneNumber,
            'shipping_zip' => $this->faker->postcode,
            'shipping_address' => $this->faker->address,
            'lang' => 'en',
            'remember_token' => Str::random(10),
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
