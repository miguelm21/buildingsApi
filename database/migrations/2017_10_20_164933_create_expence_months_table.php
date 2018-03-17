<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenceMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expence_months', function (Blueprint $table) {
            $table->increments('id');
            $table->float('expmontha');
            $table->float('expmonthb');
            $table->float('expmonthc');
            $table->float('expmonthextra');
            $table->float('expmonthtotal');
            $table->integer('partnership_id')->unsigned();
            $table->foreign('partnership_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('expence_months');
    }
}
