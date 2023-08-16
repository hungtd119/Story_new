<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\Position;
use App\Models\Text;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextConfig>
 */
class TextConfigFactory extends Factory
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
            'page_id'=>Page::all()->random()->id,
            'text_id'=>Text::all()->random()->id,
        ];
    }
}
