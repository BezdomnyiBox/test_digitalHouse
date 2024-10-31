<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = \App\Models\Review::class;

    public function definition()
    {
        return [
            'author' => $this->faker->name(),
            'content' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
