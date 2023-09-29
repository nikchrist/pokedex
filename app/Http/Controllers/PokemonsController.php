<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 40000);
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use App\Models\Pokemons;
use App\Models\PokemonCategories;

class PokemonsController extends Controller
{
    private $pokemoncatnames = [];
    private $allpokemonscount = [];
    private $endpoint = "https://pokeapi.co/api/v2/pokemon";

    public function index(){
        $this->getPokemons();
        $allpokemons = Pokemons::with(['pokemon_categories'])->paginate(50);
        return view('home',compact('allpokemons'));
    }

        function countPokemons(){
            return Http::async()->get($this->endpoint)
            ->then( function($response) {return $response->object()->count; })->wait();
        }

    public function getPokemons(){
        if(Pokemons::exists())
        {
            return;
        }
        $this->getCategories();
        $limit = -1;
        $offset = 0;
        $mainurl = $this->endpoint.'?limit='.$limit.'&offset='.$offset;
        /*Get all pokemons  */
        Http::async()->get($mainurl)
        ->then(function($response){
            return $response->object()->results;
        })->then(function($response){
            foreach($response as $pokemon_name_obj)
            {
                $name  = $pokemon_name_obj->name;
                $pokemoninfo = Http::pool(function(Pool $pool)use($name){
                    return $pool->get("https://pokeapi.co/api/v2/pokemon/".$name);
                });
                foreach($pokemoninfo as $singlepokemon)
                {
                    $pokemoninfo = [];
                    $pokemon = new Pokemons;
                    $pokemonobj = $singlepokemon->object();
                    $pokemon->name = $pokemonobj->name;
                    $pokemon->weight = $pokemonobj->weight;
                    $pokemon->height = $pokemonobj->height;
                    $pokemon->pokemonid = $pokemonobj->id;
                    $pokemon_stats = $pokemonobj->stats;
                    $pokemon_types = $pokemonobj->types;
                    $pokemon->image = $pokemonobj->sprites->front_shiny;
                    foreach($pokemon_stats as $stat)
                    {
                        switch($stat->stat->name)
                        {
                            case("hp"):
                                $pokemon->hp= $stat->base_stat;
                            break;
                            case("special-defense"):
                                $pokemon->special_defence = $stat->base_stat;
                            break;
                            case("special-attack"):
                                $pokemon->special_attack = $stat->base_stat;
                            break;
                            case("attack"):
                                $pokemon->attack = $stat->base_stat;
                            break;
                            case("defense"):
                                $pokemon->defence = $stat->base_stat;
                            break;
                            case("speed"):
                                $pokemon->speed = $stat->base_stat;
                            break;
                        }
                    }
                    $pokemon->save();
                    $this->pokemoncatnames = PokemonCategories::select('id','name')->get();
                    foreach($pokemon_types as $type)
                    {
                        foreach($this->pokemoncatnames->toArray() as $existingcatname)
                        {
                            if($existingcatname["name"] == $type->type->name)
                            {
                                DB::table('pokemon_categories_pokemons')->insert(
                                    [
                                        "pokemon_categories_id" => $existingcatname["id"],
                                        "pokemons_id" => $pokemon->id
                                    ]
                                );
                            }
                        }
                    }
                }
        }
        })->wait();
    
    }

    public function getCategories(){
        if(PokemonCategories::exists() )
        {
            return;
        }
        $allcategories = Http::async()->get("https://pokeapi.co/api/v2/type")
                ->then(function($response){
                    return $response->object()->results;
                })->wait();
                foreach($allcategories as $category)
                {
                    $pokemoncat = new PokemonCategories;
                    $pokemoncat->name = $category->name;
                    $pokemoncat->save();
                }
                
    }

    public function updatePokemons(){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('pokemon_categories_pokemons')->truncate();
        DB::table('pokemon_categories')->truncate();
        DB::table('pokemons')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        $allcategories = Http::async()->get("https://pokeapi.co/api/v2/type")
                ->then(function($response){
                    return $response->object()->results;
                })->wait();
                foreach($allcategories as $category)
                {
                    $pokemoncat = new PokemonCategories;
                    $pokemoncat->name = $category->name;
                    $pokemoncat->save();
                }
        $limit = -1;
        $offset = 0;
        $mainurl = $this->endpoint.'?limit='.$limit.'&offset='.$offset;
        /*Get all pokemons  */
        Http::async()->get($mainurl)
        ->then(function($response){
            return $response->object()->results;
        })->then(function($response){
            foreach($response as $pokemon_name_obj)
            {
                $name  = $pokemon_name_obj->name;
                $pokemoninfo = Http::pool(function(Pool $pool)use($name){
                    return $pool->get("https://pokeapi.co/api/v2/pokemon/".$name);
                });
                foreach($pokemoninfo as $singlepokemon)
                {
                    $pokemoninfo = [];
                    $pokemon = new Pokemons;
                    $pokemonobj = $singlepokemon->object();
                    
                    $pokemon->name = $pokemonobj->name;
                    $pokemon->weight = $pokemonobj->weight;
                    $pokemon->height = $pokemonobj->height;
                    $pokemon->pokemonid = $pokemonobj->id;
                    $pokemon_stats = $pokemonobj->stats;
                    $pokemon_types = $pokemonobj->types;
                    $pokemon->image = $pokemonobj->sprites->front_shiny;
                    foreach($pokemon_stats as $stat)
                    {
                        switch($stat->stat->name)
                        {
                            case("hp"):
                                $pokemon->hp= $stat->base_stat;
                            break;
                            case("special-defense"):
                                $pokemon->special_defence = $stat->base_stat;
                            break;
                            case("special-attack"):
                                $pokemon->special_attack = $stat->base_stat;
                            break;
                            case("attack"):
                                $pokemon->attack = $stat->base_stat;
                            break;
                            case("defense"):
                                $pokemon->defence = $stat->base_stat;
                            break;
                            case("speed"):
                                $pokemon->speed = $stat->base_stat;
                            break;
                        }
                    }
                    $pokemon->save();
                    $this->pokemoncatnames = PokemonCategories::select('id','name')->get();
                    foreach($pokemon_types as $type)
                    {
                        foreach($this->pokemoncatnames->toArray() as $existingcatname)
                        {
                            if($existingcatname["name"] == $type->type->name)
                            {
                                DB::table('pokemon_categories_pokemons')->insert(
                                    [
                                        "pokemon_categories_id" => $existingcatname["id"],
                                        "pokemons_id" => $pokemon->id
                                    ]
                                );
                            }
                        }
                    }
                }
        }
        })->wait();
    }

}
