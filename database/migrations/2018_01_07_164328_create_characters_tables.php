<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('race_id')->unsigned();
            $table->bigInteger('starting_experience')->unsigned();
            $table->timestamps();
        });

        Schema::create('experience_records', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->text('title');
            $table->mediumText('source');
            $table->integer('amount')->unsigned();
            $table->timestamps();
        });

        Schema::create('character_experience_record', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->integer('character_id')->unsigned();
            $table->bigInteger('experience_record_id')->unsigned();

            $table->foreign('character_id')
                ->references('id')
                ->on('characters')
                ->onDelete('cascade');

            $table->foreign('experience_record_id')
                ->references('id')
                ->on('experience_records')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('character_experience_record');
        Schema::dropIfExists('experience_records');
        Schema::dropIfExists('characters');
    }
}
