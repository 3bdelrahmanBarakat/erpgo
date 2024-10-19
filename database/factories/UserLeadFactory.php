<?php

namespace Database\Factories;

use App\Models\UserLead;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserLeadFactory extends Factory
{
    protected $model = UserLead::class;

    public function definition(): array
    {
        return [
            'user_id' => 6,
            'lead_id' => rand(1,150),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
