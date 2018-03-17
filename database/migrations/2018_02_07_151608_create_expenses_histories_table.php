<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnerships_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->float('igPorDeuda')->default(0);
            $table->float('igPorExpMes')->default(0);
            $table->float('igPorInt')->default(0);
            $table->float('igPorExtra')->default(0);
            $table->float('expenses')->default(0);
            $table->float('previousbalance')->default(0);
            $table->float('totalIg')->default(0);
            $table->string('date');
            $table->date('date2');
            $table->integer('partnership_id')->unsigned();
            $table->foreign('partnership_id')->references('id')->on('partnerships')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('partnerships_histories');
    }
}
