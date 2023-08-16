<?php

namespace Database\Seeders;

use App\Models\Audio;
use App\Models\Textconfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Textconfig::factory()->count(10)->create();
    }
}
