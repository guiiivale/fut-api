<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersMatchCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_match_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained();
            $table->foreignId('match_id')->constrained();
            $table->integer('yellow_cards');
            $table->integer('red_cards');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_match_cards');
    }
}
