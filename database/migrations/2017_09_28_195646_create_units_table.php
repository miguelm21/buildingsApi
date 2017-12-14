<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('phone');
            $table->string('floor');
            $table->string('deparment');
            $table->string('unit');
            $table->float('percent_a');
            $table->float('percent_b');
            $table->float('percent_c');
            $table->float('debt')->nullable();
            $table->float('previousbalance');
            $table->boolean('prorateado')->nullable();
            $table->string('enterinterests');
            $table->string('mail');
            $table->string('observations');
            $table->integer('partnership_id')->unsigned();
            $table->foreign('partnership_id')->references('id')->on('partnerships');
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
        Schema::dropIfExists('units');
    }
}
