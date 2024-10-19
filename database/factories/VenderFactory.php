<?php

namespace Database\Factories;

use App\Models\Vender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VenderFactory extends Factory
{
    protected $model = Vender::class;

    public function definition(): array
    {
        return [
            'vender_id' => $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('1234'),
            'contact' => $this->faker->phoneNumber,
            'created_by' => 2,
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
            'lang' => $this->faker->languageCode,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
