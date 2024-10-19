<?php

namespace Database\Factories;

use App\Models\ProductService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class ProductServiceFactory extends Factory
{
    protected $model = ProductService::class;

    public function definition(): array
    {


        return [
            'name' => $this->faker->safeColorName,
            'sku' => $this->faker->randomDigitNotNull,
            'sale_price' => $this->faker->randomFloat(2, 10, 100),
            'purchase_price' => $this->faker->randomFloat(2, 5, 50),
            'quantity' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 5),
            'unit_id' => $this->faker->numberBetween(1, 3),
            'type' => "product",
            'description' => $this->faker->paragraph,
            'created_by' => 2
        ];
    }
}
