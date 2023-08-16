<?php

namespace Database\Factories;

use App\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Audio>
 */
class AudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->numerify("########"),
            'filename'=>$this->faker->name,
            'path'=>$this->faker->url,
            'time'=>$this->faker->numerify,
            'text_id'=>Text::all()->random()->id
        ];
    }
}
