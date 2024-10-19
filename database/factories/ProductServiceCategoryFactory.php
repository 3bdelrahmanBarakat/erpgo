<?php

namespace Database\Factories;

use App\Models\ProductServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductServiceCategoryFactory extends Factory
{
    protected $model = ProductServiceCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'type' => rand(0,2),
            'color' => $this->faker->hexColor,
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
