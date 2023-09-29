<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Pokemons;
use Illuminate\Support\Facades\Http;

class getPokemons implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $pokemon;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
       
    }

    /**
     * Execute the job.
     */
    /*public function handle(): void
    {
        $limit = 100;
        $endpoint = "https://pokeapi.co/api/v2/pokemon";
        $offset = 0;
        $hundredpokemons = Http::async()->get($endpoint.'?limit='.$limit.'&offset='.$offset)
        ->then(function($response){
            return $response->object();
        })->wait();
        $this->pokemonsdata[] = $hundredpokemons->results;
        $limit+=100;
        
    } */
}
