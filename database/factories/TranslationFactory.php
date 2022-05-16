<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'word_origin_id' => Word::factory(['language_id' => 1]),
            'word_translation_id' => Word::factory(['language_id' => 2])
        ];
    }
}
