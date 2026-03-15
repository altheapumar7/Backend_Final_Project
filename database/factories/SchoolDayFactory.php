<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolDayFactory extends Factory
{
    public function definition(): array
    {
        $types = ['Regular', 'Holiday', 'Event'];
        $type = fake()->randomElement($types);
        $description = null;
        if ($type === 'Holiday') {
            $description = fake()->randomElement(['Charter Day', 'Labor Day', 'National Heroes Day']);
        } elseif ($type === 'Event') {
            $description = fake()->randomElement(['Foundation Day', 'Intramurals', 'Acads Night']);
        }

        return [
            'date' => fake()->unique()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'type' => $type,
            'description' => $description,
            'is_school_day' => ($type === 'Regular'), 
        ];
    }
}