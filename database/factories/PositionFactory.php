<?php

namespace Database\Factories;

use App\Models\Interaction;
use App\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->numerify('########'),
            'position_x'=>$this->faker->numerify("###"),
            'position_y'=>$this->faker->numerify("###"),
            'width'=>$this->faker->numerify("###"),
            'height'=>$this->faker->numerify("###"),
            'text_id'=>Text::all()->random()->id,
            'interaction_id'=>Interaction::all()->random()->id,
        ];
    }
}
