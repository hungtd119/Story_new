<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Page;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Page::class;
    public function definition()
    {
        return [
            'id'=>$this->faker->numerify("########"),
            'image_id'=>Image::all()->random()->id,
            'page_number'=>$this->faker->numerify,
            'story_id'=>Story::all()->random()->id,
        ];
    }
}
