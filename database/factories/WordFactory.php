<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'language_id' => 1
        ];
    }
}
