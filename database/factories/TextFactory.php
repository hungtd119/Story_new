<?php

namespace Database\Factories;

use App\Models\Audio;
use App\Models\Position;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Text>
 */
class TextFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numerify("########"),
            'text' => $this->faker->sentence,
            'wordSync' => $this->faker->sentence,
            'isIcon' => $this->faker->boolean,
        ];
    }
}
