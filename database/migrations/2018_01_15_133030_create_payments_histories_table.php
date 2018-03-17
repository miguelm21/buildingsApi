<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->float('amount');
            $table->float('balance');
            $table->string('observation')->nullable();
            $table->float('enterent')->nullable();
            $table->float('enterexp')->nullable();
            $table->float('enterdebt')->nullable();
            $table->float('expmonth')->nullable();
            $table->float('previousbalance')->nullable();
            $table->float('debt')->nullable();
            $table->float('interest')->nullable();
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('payments_histories');
    }
}
