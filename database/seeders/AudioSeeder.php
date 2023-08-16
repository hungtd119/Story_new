<?php

namespace Database\Seeders;

use App\Models\Audio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Audio::factory()->count(10)->create();
    }
}
