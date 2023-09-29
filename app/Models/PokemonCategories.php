<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pokemons;

class PokemonCategories extends Model
{
    use HasFactory;

    
    protected $fillable = ['pokemon_categories_id'];

    public function pokemons(){
        
        return $this->belongsToMany(Pokemons::class, 'pokemon_categories_pokemons', 'pokemon_categories_id', 'pokemons_id');
    }
}
