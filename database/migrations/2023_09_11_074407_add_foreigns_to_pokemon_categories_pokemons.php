<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pokemon_categories_pokemons', function (Blueprint $table) {
            $table->
                foreign('pokemon_categories_id')->
                references('id')->
                on('pokemon_categories')->
                constrained()->
                onUpdate('CASCADE')->
                onDelete('CASCADE');
            $table->
                foreign('pokemons_id')->
                references('id')->
                on('pokemons')->
                constrained()->
                onUpdate('CASCADE')->
                onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemon_categories_pokemons', function (Blueprint $table) {
            $table->dropForeign(['pokemon_categories_id']);
            $table->dropForeign(['pokemons_id']);
        });
    }
};
