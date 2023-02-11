<?php

namespace RageKings\NovaSettings\Database\Factories\Models;

use RageKings\NovaSettings\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionFactory extends Factory
{
    protected $model = Option::class;

    public function definition(): array
    {
        return [
            'key' => 'key_test' . $this->faker->numberBetween(1, 999999999999999),
            'title' => $this->faker->name,
            'value' => $this->faker->text,
            'type' => 'text',
            'description' => $this->faker->text,
            'panel' => 'Settings',
            'order' => 1
        ];
    }
}
