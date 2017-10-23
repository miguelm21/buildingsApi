<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnershipsBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnerships_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->float('debt');
            $table->float('expmonth');
            $table->float('int');
            $table->float('expenditures');
            $table->string('period');
            $table->float('previousbalance');
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
        Schema::dropIfExists('partnerships_balances');
    }
}
