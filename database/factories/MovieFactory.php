<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'external_id' => mt_rand(100000, 999999),
            'title' => $this->faker->sentence,
            'overview' => $this->faker->paragraph,
            'release_date' => $this->faker->date,
            'popularity' => $this->faker->randomFloat(2, 0, 10),
            'vote_average' => $this->faker->randomFloat(1, 0, 10),
            'vote_count' => $this->faker->numberBetween(0, 1000),
            'original_language' => $this->faker->languageCode,
            'poster_path' => $this->faker->imageUrl(),
            'backdrop_path' => $this->faker->imageUrl(),
            'adult' => $this->faker->boolean,
            'video' => $this->faker->boolean,
            'user_id' => \App\Models\User::factory()->create()->id,
        ];
    }
}
