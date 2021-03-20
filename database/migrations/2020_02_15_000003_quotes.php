<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('episode_id');
            $table->unsignedBigInteger('character_id');
            $table->mediumText('quote');
            $table->timestamps();
            
            $table->foreign('episode_id')->references('id')->on('episodes');
            $table->foreign('character_id')->references('id')->on('characters');
        });        
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
