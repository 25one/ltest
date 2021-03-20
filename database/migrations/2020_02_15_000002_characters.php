<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Characters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('birthday');
            $table->json('occupations');
            $table->string('img');
            $table->string('nickname');
            $table->string('portrayed');
            $table->timestamps();
        });        
        
        //если поиск по полному имени (в условии не уточнено)
        DB::statement('ALTER TABLE `characters` ADD FULLTEXT INDEX characters_name_index (name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //если поиск по полному имени (в условии не уточнено)
        Schema::table('characters', function($table) {
	    $table->dropIndex('characters_name_index');
	});

        Schema::dropIfExists('characters');
    }
}
