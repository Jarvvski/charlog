<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataStorage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dice_index', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->integer('dice_sides')->unsigned();
            $table->integer('tier')->unsigned();
            $table->bigInteger('experience_required')->unsigned();

            $table->primary('dice_sides');

        });

        Schema::create('races', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->integer('health_bonus')->unsigned();
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
        Schema::dropIfExists('races');
        Schema::dropIfExists('dice_index');
    }
}
