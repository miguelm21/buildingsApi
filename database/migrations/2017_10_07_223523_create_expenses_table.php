<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('concept');
            $table->date('date');
            $table->float('amount_a');
            $table->float('amount_b');
            $table->float('amount_c');
            $table->integer('rubro');
            $table->integer('repeat');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units');
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
        Schema::dropIfExists('expenses');
    }
}
