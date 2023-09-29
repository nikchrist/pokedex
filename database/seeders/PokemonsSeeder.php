<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pokemons;

class PokemonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pokemons::factory()->count(10)->create();

        foreach(Pokemons::all() as $pokemon)
        {
            $pokemoncategories = \App\Models\PokemonCategories::inRandomOrder()->take(rand(1,5))->pluck('id');
            $pokemon->pokemon_categories()->attach($pokemoncategories);
        }
    }
}
