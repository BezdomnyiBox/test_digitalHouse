<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharacteristicFactory extends Factory
{
    protected $model = \App\Models\Characteristic::class;

    public function definition()
    {
        return [
            'key' => $this->faker->word(),
            'value' => $this->faker->word(),
        ];
    }
}
