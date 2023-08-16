<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Story::class;
    public function definition()
    {
        return [
            'id'=>$this->faker->numerify("########"),
            'title' => $this->faker->title,
            'image_id' =>Image::all()->random()->id,
            'author'=>$this->faker->name,
            'illustrator'=>$this->faker->name,
            'level'=>$this->faker->word,
            'coin'=>$this->faker->numerify
        ];
    }
}
