<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->e164PhoneNumber,
            'subject' => $this->faker->paragraph,
            'user_id' => rand(1,5),
            'pipeline_id' => 1,
            'stage_id' => rand(1,5),
            'sources' => rand(1, 5) . ',' . rand(1, 5),
            'products' => rand(1, 70) . ',' . rand(1, 70) . ',' . rand(1, 70) . ',' . rand(1, 70),
//            'notes' => $this->faker->text,
//            'labels' => $this->faker->word,
            'order' => 0,
            'created_by' => 6,
            'is_active' => 1,
            'is_converted' => 0,
            'date' => $this->faker->dateTimeThisYear,
        ];
    }
}
