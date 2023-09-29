<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PokemonCategories;

class PokemonCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PokemonCategories::factory()->count(5)->create();

        foreach(PokemonCategories::all() as $poekemoncategory)
        {
            $pokemons = \App\Models\Pokemons::inRandomOrder()->take(rand(1,10))->pluck('id');
            $poekemoncategory->pokemons()->attach($pokemons);
        }
    }
}
