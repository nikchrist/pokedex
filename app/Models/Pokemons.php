<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PokemonCategories;

class Pokemons extends Model
{
    use HasFactory;

    protected $fillable= ['pokemons_id'];

    public function pokemon_categories(){

        return $this->belongsToMany(PokemonCategories::class, 'pokemon_categories_pokemons', 'pokemons_id', 'pokemon_categories_id');
    }
}
