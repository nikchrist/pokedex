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
        Schema::create('pokemons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pokemonid')->nullable()->default(0);
            $table->string('name');
            $table->string('image')->nullable()->default('./images/pokemon-logo-png-1447_50x50');
            $table->double('weight');
            $table->mediumInteger('height');
            $table->mediumInteger('hp');
            $table->mediumInteger('special_defence');
            $table->mediumInteger('special_attack');
            $table->mediumInteger('attack');
            $table->mediumInteger('defence');
            $table->mediumInteger('speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};
