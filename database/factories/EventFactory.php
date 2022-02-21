<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'start_at' => date('Y-m-d H:i:s', strtotime('-1 week', strtotime(date("Y-m-d H:i:s")))),
            'end_at' => date('Y-m-d H:i:s', strtotime('+1 week', strtotime(date("Y-m-d H:i:s")))),
            'deleted_at' => null,
        ];
    }
}
