<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PokemonCategories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PokemonCategories>
 */
class PokemonCategoriesFactory extends Factory
{
    protected $model = PokemonCategories::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(10)
        ];
    }
}
