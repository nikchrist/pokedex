<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemons;

class WishListController extends Controller
{
    public function show(Request $request){
        $allpokemons = Pokemons::with(['pokemon_categories'])
        ->where('wishlist',true)
        ->orderBy('weight','desc')
        ->paginate(20);

        if($request->ajax())
        {
            return response()->json([
                'html' => view('components.pokemon-card-ajax',compact('allpokemons'))->render()
            ]);
        }else{
            return view('home',compact('allpokemons'));
        }
    }

    public function update($id){
        $pokemon = Pokemons::find($id);
        switch($pokemon->wishlist)
        {
            case true:
                $pokemon->wishlist = false;
            break;
            case false:
                $pokemon->wishlist = true;
            break;
        }
        $pokemon->save();
    }
}
