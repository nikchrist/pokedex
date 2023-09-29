<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pokemons;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pokemons>
 */
class PokemonsFactory extends Factory
{
    protected $model = Pokemons::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'weight' => $this->faker->randomNumber(2),
            'height' => $this->faker->randomNumber(2),
            'hp' => $this->faker->numberBetween(0, 9999),
            'special_defence' => $this->faker->numberBetween(0, 999),
            'special_attack' => $this->faker->numberBetween(0, 999),
            'attack' => $this->faker->numberBetween(0, 999),
            'defence' => $this->faker->numberBetween(0, 999),
            'speed' => $this->faker->numberBetween(0, 999),
        ];
    }
}
