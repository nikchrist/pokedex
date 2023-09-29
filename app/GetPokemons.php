<?php
namespace App;
use PokePHP\PokeApi;
/* Get all pokemons from https:pokeapi.com */

class GetPokemons{

  private $pokeapi;

  public function __construct(){
    $this->pokeapi = new PokeApi;
  }

  public function getAll(){
    return $this->pokeapi->resourceList('pokemon',-1,0);
  }
}
?>