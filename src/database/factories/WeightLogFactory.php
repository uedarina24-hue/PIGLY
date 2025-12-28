<?php

namespace Database\Factories;

use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id' => null,
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 50, 80),
            'calories' => $this->faker->numberBetween(1500, 3000),
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => $this->faker->realText(50),
        ];
    }
}
