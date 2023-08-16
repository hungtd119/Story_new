<?php

namespace Database\Factories;

use App\Models\Blink;
use App\Models\Image;
use App\Models\Page;
use App\Models\Pronoun;
use App\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interaction>
 */
class InteractionFactory extends Factory
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
            'bg'=>$this->faker->colorName(),
            'blink'=>$this->faker->sentence,
            'image_id'=>Image::all()->random()->id,
            'page_id'=>Page::all()->random()->id,
            'text_id'=>Text::all()->random()->id,
        ];
    }
}
